<?php


namespace App\Http\Controllers\api\attendance;


use App\Http\Controllers\Controller;
use App\Models\AttBreak;
use App\Models\Attendance;
use App\Models\AttReceiver;
use App\Models\LogAttendance;
use App\Models\User;
use App\Models\UserEmployee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Exception as ExceptionAlias;

class LiFiAttendanceController extends Controller
{

    public function __construct(Request $request)
    {
//        if (!$request->hasHeader('device')) {
//            $this->return_response_pole($this->pole_fail_data_value, "Missing Data.");
//        }
    }

    /**
     * Login for Smart Pole only with
     * new pole user creation via MAC-
     * Address.
     *
     * @param Request $request
     */
    public function login(Request $request)
    {
        $rules = [
            'mac' => 'required|max:17',
            'password' => 'required',
        ];

        $token = '';

//        print_r($request);

        if ($this->ApiValidator($request->all(), $rules)) {
            $mac_address = strtoupper($request->mac ?? null);
            str_replace(":", "", $mac_address);

            $password = $request->password;

            if (Auth::attempt(['mac_address' => $mac_address
                , 'password' => $password])) {

                $user = Auth::user();
                $token = create_user_auth_token($user);

            } else {
                $user = User::where('mac_address', $mac_address)->first(['id']);
                if (empty($user)) {
                    $token = $this->create_att_receiver($request);
                } else {
                    $this->return_response_pole($this->pole_fail_data_value, "Wrong Password");
                }
            }
        } else {
//            $this->return_response_pole($this->pole_fail_data_value, "Wrong Parameter");
            $this->return_response_pole($this->pole_fail_data_value, $this->ApiValidatorWithErrors($request->all(), $rules));
        }
        $data = "$token";
        $this->return_response_pole($this->pole_auth_value, $data);
    }

    /**
     * Create/Register new Attendance Receiver as user.
     *
     * @param Request $request
     * @return string
     */
    private function create_att_receiver(Request $request): string
    {
        $token = '';
        try {

            $mac_address = strtoupper($request->mac ?? null);
            $password = $request->password ?? null;

            $name = 'Attendance Receiver ESP';

            $user = User::where('mac_address', $mac_address)->first(['id']);
            if ($user) {
                $this->return_response_pole($this->pole_fail_data_value, "Duplicate MAC Address");
            } else {
                $input = array();
                $input['name'] = $name;
                $input['mac_address'] = $mac_address;
                $input['password'] = bcrypt($password);
                $user = User::create($input);

                if ($user) {
                    if (Auth::attempt(['mac_address' => $mac_address
                        , 'password' => $password])) {

                        $user = Auth::user();
                        $token = create_user_auth_token($user);

                        $device = create_new_device($user, $name, $mac_address, 2);

                        $input = array();
                        $input['device_id'] = $device->id;
                        $input['created_by'] = Auth::user()->id;
                        $input['updated_by'] = Auth::user()->id;
                        $att_receiver = AttReceiver::create($input);

                    } else {
                        $this->return_response_pole($this->pole_fail_data_value, "Login Fail");
                    }
                }
            }
        } catch (ExceptionAlias $ex) {
            $this->return_response_pole($this->pole_fail_data_value, $ex);
        }

        return $token;
    }

    public function saveAttendance(Request $request): JsonResponse
    {
        $rules = [
            'flash_code' => 'required',
        ];

        if ($this->ApiValidator($request->all(), $rules)) {
            $flash_code = $request->flash_code;

            $attendance = $this->saveAtt($flash_code);

            if ($attendance == null) {
                $this->return_response_att_error("No User Found");
            } else {
                if ($attendance) {
                    $this->return_response_att("1");
                } else {
                    $this->return_response_att_error("Something Went Wrong Please Try Again");
                }
            }
        }

        return $this->return_response();
    }

    private function saveAtt($flash_code)
    {
        $userEmployee = UserEmployee::whereFlashCode($flash_code)
            ->with(['User'])
            ->first();

        if ($userEmployee) {
            $is_break_entry = $this->checkForBreakInEntry($flash_code);

            if ($is_break_entry) {
                $attendance = $this->addOutBreakAttendance($is_break_entry);
            } else {
                $attendance = $this->checkForAlreadyInAttendance($flash_code);
                if ($attendance) {
                    $attendance = $this->addOutAttendance($attendance);
                } else {
                    $attendance = $this->addNewAttendance($flash_code, $userEmployee);
                }
            }
            $this->logAttendance($flash_code, $userEmployee);
            return $attendance;
        } else {
            //No User Found
            return null;
        }
    }

    /**
     * @param string $flash_code
     * @return Attendance|Builder|Model|\Illuminate\Database\Query\Builder|object|null
     */
    private function checkForBreakInEntry(string $flash_code)
    {
        $todayDate = getTodayDate();
        return Attendance::whereFlashCode($flash_code)
            ->where('date', '=', $todayDate)
            ->whereNotNull('out_time')
            ->orderByDesc('created_at')->first();
    }

    private function addOutBreakAttendance(Attendance $attendance): Attendance
    {
        $todayDate = getTodayDate();
        $currentDateTime = now();

        $break_time = (strtotime($currentDateTime) - strtotime($attendance->out_time)) / 3600;

        $att_break = new AttBreak();
        $att_break->attendance_id = $attendance->id;
        $att_break->flash_code = $attendance->flash_code;
        $att_break->date = $todayDate;
        $att_break->break_in_time = $attendance->out_time;
        $att_break->break_out_time = $currentDateTime;
        $att_break->break_time = $break_time;
        $att_break->created_by = Auth::user()->id;
        $att_break->updated_by = Auth::user()->id;
        $att_break->save();

        $attendance->out_time = null;
        $attendance->break_time = ($attendance->break_time ?? 0) + ($break_time ?? 0);
        $attendance->updated_by = Auth::user()->id;
        $attendance->save();

        return $attendance;

    }

    private function checkForAlreadyInAttendance(string $flash_code)
    {
        $todayDate = getTodayDate();
        return Attendance::whereFlashCode($flash_code)
            ->where('date', '=', $todayDate)
            ->whereNull('out_time')
            ->orderByDesc('created_at')->first();
    }

    private function addOutAttendance(Attendance $attendance): Attendance
    {
        $todayDate = getTodayDate();
        $currentDateTime = now();

        $hours_worked = (strtotime($currentDateTime) - strtotime($attendance->in_time)) / 3600;

        $attendance->out_time = $currentDateTime;
        $attendance->hours_worked = ($hours_worked ?? 0) - ($attendance->break_time ?? 0);
        $attendance->updated_by = Auth::user()->id;
        $attendance->save();

        return $attendance;

    }

    private function addNewAttendance(string $flash_code, UserEmployee $userEmployee): Attendance
    {
        $todayDate = getTodayDate();
        $currentDateTime = now();

        $attendance = new Attendance();
        $attendance->user_id = $userEmployee->user_id;
        $attendance->name = $userEmployee->User->name;
        $attendance->flash_code = $flash_code;
        $attendance->date = $todayDate;
        $attendance->in_time = $currentDateTime;
        $attendance->status = 1;
        $attendance->created_by = Auth::user()->id;
        $attendance->updated_by = Auth::user()->id;
        $attendance->save();

        return $attendance;
    }

    private function logAttendance($flash_code, UserEmployee $userEmployee)
    {
        $todayDate = getTodayDate();
        $currentDateTime = now();

        $attendance_log = new LogAttendance();
        $attendance_log->user_id = $userEmployee->user_id;
        $attendance_log->name = $userEmployee->User->name . ' ' . $userEmployee->User->surname;
        $attendance_log->flash_code = $flash_code;
        $attendance_log->date = $todayDate;
        $attendance_log->punch_time = $currentDateTime;
        $attendance_log->status = 1;
        $attendance_log->created_by = Auth::user()->id;
        $attendance_log->updated_by = Auth::user()->id;
        $attendance_log->save();
    }

    public function saveAttendanceWithDetails(Request $request): JsonResponse
    {
        $rules = [
            'flash_code' => 'required',
        ];

        if ($this->ApiValidator($request->all(), $rules)) {
            $flash_code = $request->flash_code;

            $attendance = $this->saveAtt($flash_code);

            if ($attendance == null) {
                $this->return_response_att_error("No User Found");
            } else {
                if ($attendance) {
                    $user_name = getUserNameFromFlashCode($flash_code);
                    $this->return_response_att("1," . $user_name . ",");
                } else {
                    $this->return_response_att_error("Something Went Wrong Please Try Again");
                }
            }
        }

        return $this->return_response();
    }
}
