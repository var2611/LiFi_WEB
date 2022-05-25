<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserEmployee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class UserController extends Controller
{

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
        $data->middle_name = $request->last_name ?? '';
        $data->last_name = $request->surname ?? '';
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->password = "password";

        return $data;
    }

    /**
     * login api
     *
     * @return JsonResponse
     */
    public function login(): JsonResponse
    {
        if (Auth::attempt(['mobile' => request('mobile'), 'password' => request('password')]) ||
            Auth::attempt(['mobile' => request('email'), 'password' => request('password')]) ||
            Auth::attempt(['email' => request('mobile'), 'password' => request('password')]) ||
            Auth::attempt(['email' => request('email'), 'password' => request('password')])
        ) {
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
//            'middle_name' => 'required',
//            'last_name' => 'required',
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
     * @return JsonResponse
     */
    public function att_register_employee(Request $request): JsonResponse
    {
        $rules = [
            'name' => 'required',
            'mobile' => 'required',
//            'email' => 'required|email',
//            'firebase_token' => 'required',
            'emp_code' => 'required',
//            'company_id' => 'required',
        ];

        if ($this->ApiValidator($request->all(), $rules)) {

            try {
                Log::info(json_encode($request->all()));
//                $name = $request->name;
//                $last_name = $request->last_name ?? '';
//                $middle_name = $request->middle_name ?? '';
//                $emp_code = $request->emp_code;
//                $firebase_token = $request->firebase_token ?? '';
//                $company_id = $request->company_id ?? 1;

                $user = Auth::user();

                $checkUserEmployeeRegistration = UserEmployee::whereUserId($user->id)
                    ->first();

                if (empty($checkUserEmployeeRegistration)) {

                    $userEmployee = att_register_new_employee($request, $user);

//                    $user->name = $name;
//                    $user->middle_name = $middle_name;
//                    $user->last_name = $last_name;
//                    $user->firebase_token = $firebase_token;
//                    $user->save();
//
//                    $userEmployee = new UserEmployee();
//                    $userEmployee->user_id = $user->id;
//                    $userEmployee->user_role_id = 2;
//                    $userEmployee->company_id = $company_id ?? 1;
//                    $userEmployee->emp_code = $emp_code;
//                    $userEmployee->flash_code = generate_random_unique_string();
//                    $userEmployee->created_by = $user->id;
//                    $userEmployee->updated_by = $user->id;
//                    $userEmployee->save();

                    $data = UserEmployee::whereId($userEmployee->id)
                        ->with(['User'])
                        ->first();

                    $this->set_return_response_success($data, "Employee has been registered successfully.");
                } else {
                    $this->set_return_response_unsuccessful("Employee with provided data already exists. Contact HR.");
                }
            } catch (Exception $exception) {
                $this->set_return_response_exception($exception);
            }
        }

        return $this->return_response();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function att_check_user_registration(Request $request): JsonResponse
    {
        $rules = [
            'mobile' => 'required',
//            'firebase_token' => 'required',
        ];


        if ($this->ApiValidator($request->all(), $rules)) {
            $mobile = $request->mobile;
            $firebase_token = $request->firebase_token ?? null;

            $user = User::whereMobile($mobile)->first();
            if (!empty($user)) {

                if (isset($firebase_token)) {
                    saveFirebaseToken($user->id, $firebase_token);
                }

                $user_employee = UserEmployee::whereUserId($user->id)->first();
                $data['token'] = create_user_auth_token($user);

                if (!empty($user_employee)) {
                    $application_code = $request->header('ApplicationCode') ?? '';

                    if ($application_code == 'BGAUSS') {
                        $allowed_roles = array(1, 2, 3);
                        if (in_array($user_employee->user_role_id, $allowed_roles)) {

                            $data['is_valid_user'] = true;
                            $data['is_valid_employee'] = true;
                            $this->set_return_response_success($data, "User Employee Validation Successful");
                        } else {
                            $this->set_return_response_unauthorised("User is not authorized.");
                        }
                    } else {
                        $this->set_return_response_unauthorised();
                    }
                } else {
                    $data['is_valid_user'] = true;
                    $data['is_valid_employee'] = false;
                    $this->set_return_response_success($data, "User Validation Success, need to register.");
                }
            } else {
                $user = att_register_user($mobile, "New User", $firebase_token);
                if (!empty($user)) {
                    $data['token'] = create_user_auth_token($user);
                    $data['is_valid_user'] = true;
                    $data['is_valid_employee'] = false;
                    $this->set_return_response_success($data, "User Validation Success, need to register.");
                } else {
                    $this->set_return_response_unauthorised();
                }
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
//            'firebase_token' => 'required',
        ];

        if ($this->ApiValidator($request->all(), $rules)) {

            try {
                $mobile = $request->mobile;
                $firebase_token = $request->firebase_token ?? null;

                $userEmployee = UserEmployee::whereUserId(User::whereMobile($mobile)->first()->id)
                    ->with(['User'])
                    ->first();
                if (!empty($userEmployee)) {

                    if (isset($firebase_token)) {
                        saveFirebaseToken($userEmployee->User->id, $firebase_token);
                    }

                    $this->set_return_response_success($userEmployee, "User Details.");
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
//                    test();
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
