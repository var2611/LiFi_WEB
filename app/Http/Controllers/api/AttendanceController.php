<?php


namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\UserEmployee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{

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
}
