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
        $api_url='@api.razorpay.com/v1/';

        $server_key = 'AAAAy-1xPcY:APA91bHqJD_2NS_shwPWZcT3HkbtrVRprO4JOi-8AVGTEnBgubVPcDVSMz8Ld2VApCDPozPiXsvJC00BhOxSgcqD8VB8y45LaFcZVo901GixNd_5tknJoEaRT2ZTKuXfAm6E_eC5Leyc';
//        echo "Demo Working";
        $data['test'] = 'Demo';

//        $data['test'] = send("918460113626","test");
        $this->set_return_response_success($data, "User Logged In Successfully.");
//        $this->set_return_response_unauthorised("Username or Password is incorrect.");


//        test();
        return $this->return_response();

    }

    public function demo1()
    {


        $data['test'] = 'Demo';
//
//        $data = send("918460113626","test");
        $this->set_return_response_success($data, "User Logged In Successfully.");
//        $this->set_return_response_unauthorised("Username or Password is incorrect.");

        return $this->return_response();

    }

    /**
     * login api
     *
     * @return JsonResponse|Response
     */
    public function login()
    {
        if (Auth::attempt(['mobile' => request('mobile'), 'password' => request('password')])) {
            $user = Auth::user();
            $data['token'] = $user->createToken('MyApp')->accessToken;

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
                    $data['token'] = $user->createToken('MyApp')->accessToken;
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
     * @return JsonResponse|Response
     */
    public function user_details()
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

    public function smsToMobile(Request $request){
        $rules = [
            'mobile' => 'required',
        ];

        if ($this->ApiValidator($request->all(), $rules)) {

            try {
//
                $input = $request->all();
                $otp = rand(1000,9999);
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

    function test(){
//    print_r("test");
    }
}
