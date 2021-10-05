<?php


namespace App\Http\Controllers\api\attendance;


use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\UserEmployee;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Exception;

class AttendanceController extends Controller
{
    public function __construct(Request $request)
    {
//        if (!$request->hasHeader('device')) {
//            $this->return_response_pole($this->pole_fail_data_value, "Missing Data.");
//        }
    }

    public function getAttendance(Request $request): JsonResponse
    {
        $rules = [
            'from_date' => 'required',
            'to_date' => 'required',
//            'emp_code' => 'required',
        ];

        try {

            if (apiAccessCheck([1, 4])) {
                if ($this->ApiValidator($request->all(), $rules)) {
                    $emp_code = $request->emp_code ?? null;
                    $from_date = $request->from_date;
                    $to_date = $request->to_date;

                    $attendanceData = Attendance::whereBetween('date', [date('Y-m-d', strtotime($from_date)), date('Y-m-d', strtotime($to_date))]);

                    if ($request->has('emp_code')) {
                        $user = UserEmployee::whereEmpCode(strtoupper($emp_code))->first(['user_id']);

                        if ($user)
                            $attendanceData = $attendanceData->whereUserId($user->user_id);
                        else
                            $this->set_return_response_unsuccessful("Employee Code does not exist.");
                    }

                    $attendanceData = $attendanceData->join('users', 'users.id', '=', 'attendances.user_id')
                        ->join('user_employees', 'user_employees.user_id', '=', 'users.id')
                        ->where('user_employees.company_id', Auth::user()->getCompanyId());

                    $data = $attendanceData->get([
                        'attendances.id',
                        'user_employees.emp_code',
                        'users.name as FirstName',
                        'users.last_name as MiddleName',
                        'users.surname as LastName',
                        'attendances.date',
                        'attendances.in_time',
                        'attendances.out_time',
                        'attendances.hours_worked',
                        'attendances.break_time',
                        'attendances.difference',
                    ]);

                    if (!empty($data) && sizeof($data) > 0)
                        $this->set_return_response_success($data, "Attendance List Data.");
                    else
                        $this->set_return_response_unsuccessful("Attendance List Data has some issue check provided parameters or contact website Administrator.");
                }
            } else {
                $this->set_return_response_unauthorised("Access Denied.");
            }
        } catch (Exception $exception) {
            $this->set_return_response_exception($exception);
        }
        return $this->return_response();
    }
}
