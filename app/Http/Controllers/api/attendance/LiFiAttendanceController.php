<?php


namespace App\Http\Controllers\api\attendance;


use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttReceiver;
use App\Models\User;
use App\Models\UserEmployee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Exception as ExceptionAlias;

class LiFiAttendanceController extends Controller
{

    public function __construct(Request $request)
    {
        if (!$request->hasHeader('device')) {
            $this->return_response_pole($this->pole_fail_data_value, "Missing Data.");
        }
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

    public function saveAttendance(Request $request): JsonResponse
    {
        $rules = [
            'flash_code' => 'required',
        ];

        if ($this->ApiValidator($request->all(), $rules)) {
            $flash_code = $request->flash_code;

            $userEmployee = UserEmployee::whereFlashCode($flash_code)
                ->with(['User'])
                ->first();

            if ($userEmployee) {
                $attendance = $this->checkForAlreadyInAttendance($flash_code);
                if ($attendance) {
                    $attendance = $this->addOutAttendance($attendance);
                } else {
                    $attendance = $this->addNewAttendance($flash_code, $userEmployee);
                }

                if ($attendance) {
                    $this->return_response_att("1");
                } else {
                    $this->return_response_att_error("Something Went Wrong Please Try Again");
                }
            } else {
                //No User Found
                $this->return_response_att_error("No User Found");
            }


        }

        return $this->return_response();
    }

    private function checkForAlreadyInAttendance(string $flash_code)
    {
        $todayDate = date('Y-m-d');
        return Attendance::whereFlashCode($flash_code)
            ->where('date', '=', $todayDate)
            ->whereNull('out_time')
            ->orderByDesc('created_at')->first();
    }

    private function addOutAttendance(Attendance $attendance)
    {
        $todayDate = date('Y-m-d');
        $currentDateTime = now();

        $hours_worked = (strtotime($currentDateTime) - strtotime($attendance->in_time)) / 3600;

        $attendance->out_time = $currentDateTime;
        $attendance->hours_worked = $hours_worked;
        $attendance->updated_by = Auth::user()->id;
        $attendance->save();

        return $attendance;

    }

    private function addNewAttendance(string $flash_code, UserEmployee $userEmployee): Attendance
    {
        $todayDate = date('Y-m-d');
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
}
