<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class UserController extends Controller
{


    public function demo()
    {
        // Test
        $key = 'rzp_test_GUVGJTiE5i9WJP';
        $secret = 'RdknMJYiNOToqWHvgepYIM1H';
        $api_url = '@api.razorpay.com/v1/';

        $server_key = 'AAAAy-1xPcY:APA91bHqJD_2NS_shwPWZcT3HkbtrVRprO4JOi-8AVGTEnBgubVPcDVSMz8Ld2VApCDPozPiXsvJC00BhOxSgcqD8VB8y45LaFcZVo901GixNd_5tknJoEaRT2ZTKuXfAm6E_eC5Leyc';
//        echo "Demo Working";
//        $data['test'] = 'Demo';
//
        $data['test'] = $this->send("918460113626", "test");
        $this->set_return_response_success($data, "User Logged In Successfully.");
//        $this->set_return_response_unauthorised("Username or Password is incorrect.");


//        test();
        return $this->return_response();

    }

    function send($mobile, $message)
    {
        # code...
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

//if ($err) {
// print_r( $err);
//} else {
//showResultFailed();
//}
    }

    public function demo1()
    {


        $data['test'] = 'Demo';
//
        $data = sendSMS("918160928467", "test");
        $this->set_return_response_success($data, "User Logged In Successfully.");
//        $this->set_return_response_unauthorised("Username or Password is incorrect.");

        return $this->return_response();

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createUser(Request $request): JsonResponse
    {

        $rules = [
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
        ];

        if ($this->ApiValidator($request->all(), $rules)) {

            $email = $request->email;

            $user = User::where('email', $email)->first();

            if ($user) {
                $this->set_return_response_unsuccessful("Duplicate email, please use another email");
            } else {
                $data = $this->getUserData($request);

                $result = $data->save();
                if ($result) $this->set_return_response_success($data, "Registration Successfully.");
                else $this->set_return_response_unsuccessful("Something went wrong");

            }
        }
        return $this->return_response();

    }

    /**
     * @param Request $request
     * @return User
     */
    private function getUserData(Request $request): User
    {
        $data = new User();

        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->password = "password";

        return $data;
    }

    /**
     * login api
     *
     * @return JsonResponse|Response
     */
    public function login()
    {
        if (Auth::attempt(['mobile' => request('mobile'), 'password' => request('password')])) {
//        if (Auth::attempt(['mac_address' => request('mac_address'), 'password' => request('password')])) {

            $user = Auth::user();
            $data['token'] = create_user_auth_token($user);

            $userData = User::where('id', $user->id)
                ->first(['id', 'name', 'mobile', 'email']);
            $data['user'] = $userData;
            $this->set_return_response_success($data, "User Logged In Successfully.");
        } else {
            $this->set_return_response_unauthorised("Username or Password is incorrect.");
        }

        return $this->return_response();
    }

    /**
     * Register api
     *
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
//            'user_type_id' => 'required',
            'firebase_token' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ];

        if ($this->ApiValidator($request->all(), $rules)) {

            try {


                $input = $request->all();
                $checkUserExist = User::whereEmail($input['email'])->first();
                if (empty($checkUserExist)) {
                    $input['password'] = bcrypt($input['password']);
                    $user = User::create($input);
                    $data['token'] = create_user_auth_token($user);
                    $data['name'] = $user->name;

                    $this->set_return_response_success($data, "User has been registered successfully.");
                } else {
                    $this->set_return_response_unsuccessful("User with provided email already exists.");
                }

            } catch (Exception $exception) {
                $this->set_return_response_exception($exception);
            }

        }

        return $this->return_response();
    }

    /**
     * details api
     *
     * @return JsonResponse
     */
    public function user_details(): JsonResponse
    {
        try {
            $user = Auth::user();
            $data = User::where('id', $user->id)
                ->first(['id', 'name', 'mobile', 'email']);
            if (!empty($data)) {
                $this->set_return_response_success($data, "User Details.");
            } else {
                $this->set_return_response_no_data_found();
            }
        } catch (Exception $exception) {
            $this->set_return_response_exception($exception);
        }

        return $this->return_response();
    }

    /**
     * Register api
     *
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function att_register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
//            'user_type_id' => 'required',
            'firebase_token' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ];

        if ($this->ApiValidator($request->all(), $rules)) {

            try {


                $input = $request->all();
                $checkUserExist = User::whereEmail($input['email'])->first();
                if (empty($checkUserExist)) {
                    $input['password'] = bcrypt($input['password']);
                    $user = User::create($input);
                    $data['token'] = create_user_auth_token($user);
                    $data['name'] = $user->name;

                    $this->set_return_response_success($data, "User has been registered successfully.");
                } else {
                    $this->set_return_response_unsuccessful("User with provided email already exists.");
                }

            } catch (Exception $exception) {
                $this->set_return_response_exception($exception);
            }

        }

        return $this->return_response();
    }

    /**
     * details api
     *
     * @return JsonResponse
     */
    public function att_user_details(Request $request): JsonResponse
    {
        $rules = [
            'mobile' => 'required',
        ];

        if ($this->ApiValidator($request->all(), $rules)) {

            try {
                $mobile = $request->mobile;

                $data = User::whereMobile($mobile)
                    ->first(['id', 'name', 'mobile', 'email']);
                if (!empty($data)) {
                    $this->set_return_response_success($data, "User Details.");
                } else {
                    $this->set_return_response_no_data_found();
                }
            } catch (Exception $exception) {
                $this->set_return_response_exception($exception);
            }
        }

        return $this->return_response();
    }

    public function smsToMobile(Request $request)
    {
        $rules = [
            'mobile' => 'required',
        ];

        if ($this->ApiValidator($request->all(), $rules)) {

            try {
//
                $input = $request->all();
                $otp = rand(1000, 9999);
                if (!empty($otp)) {

                    $data['otp'] = $otp;
//                    print_r("Mobile");
//
                    test();
//
//                    if (isset($request->mobile)) {
//                        print_r("Mobile");
//                        send($request->mobile,$otp);
//                    }

                    $this->set_return_response_success($data, "User has been registered successfully.");
                } else {
                    $this->set_return_response_unsuccessful("User with provided email already exists.");
                }

            } catch (Exception $exception) {
                $this->set_return_response_exception($exception);
            }

        }

        return $this->return_response();
    }

    function test()
    {
//    print_r("test");
    }
}
