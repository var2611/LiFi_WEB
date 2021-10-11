<?php

use App\Models\AttBreak;
use App\Models\Attendance;
use App\Models\Device;
use App\Models\LeaveType;
use App\Models\User;
use App\Models\UserEmployee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

function sendSMS($mobile, $message)
{
    # code...
    echo "1";
    print_r($mobile);

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.msg91.com/api/v2/sendsms",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{ \"sender\": \"NVTECH\", \"route\": \"4\", \"country\": \"91\", \"sms\":
    [ { \"message\": \"$message\", \"to\": [ \"$mobile\"] }]}",
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTPHEADER => array(
            "authkey: 322008AkMnr19Q75e63638eP1",
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    print_r($response);
    print_r($err);

    curl_close($curl);
    return $response;

//    if ($err) {
//        print_r($err);
//    } else {
//showResultFailed();
//    }
}

/**
 * @param User $user
 * @return string
 */
function create_user_auth_token(User $user): string
{
    return $user->createToken('MyApp')->accessToken;

}

function create_new_device(User $user, string $name, string $mac_address, int $device_type_id)
{
    $input = array();
    $input['name'] = $name;
    $input['device_type_id'] = $device_type_id;
    $input['mac_address'] = $mac_address;
    $input['user_id'] = $user->id;
    $input['created_by'] = Auth::user()->id;
    $input['updated_by'] = Auth::user()->id;
    return Device::create($input);
}

/**
 * @param int $length
 * @return string
 */
function generate_random_unique_string(int $length = 6): string
{
    $randomString = generate_random_string($length);

    $user_employee = UserEmployee::whereFlashCode($randomString)->first();

    if (empty($user_employee)) {
        return $randomString;
    } else {
        generate_random_unique_string($length);
    }
}

function generate_random_string(int $length = 6): string
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

function att_register_user(string $mobile, string $name): ?User
{
    try {
        $input['mobile'] = $mobile;
        $input['name'] = $name;
        $checkUserExist = User::whereMobile($input['mobile'])->first();
        if (empty($checkUserExist)) {
            $input['password'] = bcrypt('1234');
            $user = User::create($input);
            if (!empty($user)) {
                return $user;
            }
        }

    } catch (Exception $exception) {
        return null;
    }
    return null;
}

function att_register_new_employee($data, User $user): ?UserEmployee
{
    $name = $data->name;
    $user_id = $user->id ?? null;
    $last_name = $data->last_name ?? '';
    $surname = $data->surname ?? '';
    $emp_code = $data->emp_code;
    $firebase_token = $data->firebase_token ?? null;
    $company_id = $data->company_id ?? Auth::user()->getCompanyId() ?? 1;

    if ($user_id) {

        $user->name = $name;
        $user->surname = $surname;
        $user->last_name = $last_name;
        if ($firebase_token) {
            $user->firebase_token = $firebase_token;
        }
        $user->updated_by = Auth::user()->id;
        $user->save();

        $userEmployee = UserEmployee::whereUserId($user_id)->first();
        if (empty($userEmployee)) {
            $userEmployee = new UserEmployee();
            $userEmployee->user_id = $user_id;
            $userEmployee->user_role_id = 2;
            $userEmployee->company_id = $company_id;
            $userEmployee->emp_code = strtoupper($emp_code);
            $userEmployee->flash_code = generate_random_unique_string();
            $userEmployee->created_by = Auth::user()->id;
        } else {
            $userEmployee->user_id = $user_id;
            $userEmployee->company_id = $company_id;
            $userEmployee->emp_code = strtoupper($emp_code);
        }
        $userEmployee->updated_by = Auth::user()->id;
        $userEmployee->save();

        return $userEmployee;
    }
    return null;
}

function getLeaveTypeIDByName(string $leave_type)
{
    return LeaveType::whereName($leave_type)->first()->id;
}

function getUserNameFromFlashCode($flash_code)
{
    $userEmployee = UserEmployee::whereFlashCode($flash_code)
        ->with(['User'])
        ->first();

    return $userEmployee->User->name;
}

function apiAccessCheck(array $allowed_user_roles): bool
{
    if (Auth::user()->UserApi) {
        return in_array(Auth::user()->UserApi->user_role_id, $allowed_user_roles);
    } else
        return false;
}

/**
 * @return false|string Current Date Y-m-d
 */
function getTodayDate()
{
    return date('Y-m-d');
}

function getTodayDateTime()
{
    return date('Y-m-d H:m:s');
}

function checkOutMissingEntry()
{
    $todayDate = getTodayDate();
    $todayDateTime = getTodayDateTime();
    $attendances = Attendance::join('att_breaks as ab', 'attendances.id', '=', 'ab.attendance_id')
        ->join('user_employees as ue', 'attendances.user_id', '=', 'ue.user_id')
        ->whereRaw("attendances.updated_at = ab.updated_at")
//        ->where('ue.company_id', 2)
//        ->where('attendances.user_id', 1)
//        ->where('attendances.id', 255)
        ->where('attendances.date', '!=', $todayDate)
//        ->where('ab.break_time', '>', 1)
        ->whereNull('attendances.out_time')

//        ->toSql();
//        ->with(['AttBreak'])
        ->get([
            'attendances.id',
            'attendances.user_id',
            'attendances.name',
            'attendances.flash_code',
            'attendances.date',
            'attendances.in_time',
            'attendances.out_time',
            'attendances.hours_worked',
            'attendances.break_time',
            'attendances.difference',
            'attendances.status',
            'attendances.is_active',
            'attendances.is_visible',
            'attendances.created_by',
            'attendances.updated_by',
            'attendances.deleted_by',
            'attendances.created_at',
            'attendances.updated_at',
            'attendances.deleted_at',
        ]);

    if (!empty($attendances) && count($attendances) > 0) {
        /* @var $attendance Attendance */
        foreach ($attendances as $attendance) {
            $attBreak = AttBreak::whereAttendanceId($attendance->id)->whereUpdatedAt($attendance->updated_at)->first();

            if (!empty($attBreak)) {
                $attBreak->deleted_at = $todayDateTime;
                $attBreak->deleted_by = 1;
                $attBreak->save();

                $attendance->out_time = $attBreak->break_out_time;
                $hours_worked = (strtotime($attendance->out_time) - strtotime($attendance->in_time)) / 3600;

                $attendance->hours_worked = $hours_worked;
                $attendance->break_time = $attendance->break_time ? ($attendance->break_time - $attBreak->break_time) : 0;
                $attendance->updated_by = 1;
                $attendance->save();
            }
        }
    }
}

function getUserFullName(int $id): string
{
    $user = User::whereId($id)->first();
    return $user->name . ' ' . ($user->last_name ? $user->last_name . ' ' : '') . $user->surname;
}

/**
 * @return Builder[]|Collection
 */
function getUserList()
{
    $user = Auth::user();
    $company_id = UserEmployee::whereUserId($user->id)->first()->company_id;

    $data = User::with(['UserEmployee']);
    if ($company_id != 1) {
        $data->whereHas('UserEmployee', function ($q) use ($company_id) {
            $q->where('company_id', '=', $company_id);
        });
    }
    return $data->get();
}
