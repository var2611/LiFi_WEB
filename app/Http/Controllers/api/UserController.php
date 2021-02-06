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
        echo "Demo Working";
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
}
