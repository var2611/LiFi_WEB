<?php

use App\Models\Device;
use App\Models\LeaveType;
use App\Models\User;
use App\Models\UserEmployee;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

function test()
{
//    print_r("test");
}

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
        $checkUserExist = User::whereEmail($input['mobile'])->first();
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
