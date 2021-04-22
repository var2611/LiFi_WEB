<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pole;
use App\Models\PoleDayData;
use App\Models\PoleLastState;
use App\Models\PoleLight;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use PHPUnit\Exception as ExceptionAlias;

class PoleController extends Controller
{

    public function __construct(Request $request)
    {
        if (!$request->hasHeader('pole')) {
            $this->return_response_pole($this->pole_fail_data_value, "Missing Data.");
        }
    }

    public function getCurrentTime()
    {
        $this->return_response_pole("time", date('Y-m-d H:i:s'));
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
                    $token = $this->create_pole($request);
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
     * Create/Register new pole as user.
     *
     * @param Request $request
     * @return string
     */
    private function create_pole(Request $request): string
    {
        $token = '';
        try {

            $mac_address = strtoupper($request->mac ?? null);
            $password = $request->password ?? null;

            $name = 'Pole';

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

                        $input = array();
                        $input['name'] = $name;
                        $input['mac_address'] = $mac_address;
                        $input['user_id'] = $user->id;
                        $input['created_by'] = Auth::user()->id;
                        $input['updated_by'] = Auth::user()->id;
                        $pole = Pole::create($input);

                        $input = array();
                        $input['pole_id'] = $pole->id;
                        $input['created_by'] = Auth::user()->id;
                        $input['updated_by'] = Auth::user()->id;
                        $pole_light = PoleLight::create($input);

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

    /**
     * To retrieve Pole current brightness
     * level
     */
    public function poleMain(Request $request)
    {
        $rules = [
            'data' => 'required',
        ];

        $fetchData = '';

        if ($this->ApiValidator($request->all(), $rules)) {
            $data = $request->data ?? '';
            if ($data === $this->pole_brightness_data_value) {
                $fetchData = 'brightness';
            } else if ($data === $this->pole_status_data_value) {
                $fetchData = 'status';
            }
            $pole_fetched_data = $this->getPoleData($fetchData, $this->pole_brightness_data_value);

            if ($pole_fetched_data) {
                $this->return_response_pole($data, $pole_fetched_data->$fetchData);
            } else {
                $this->return_response_pole($this->pole_fail_data_value, "Fail Response");
            }
        }
    }

    private function getPoleData(string $fetchData, string $pole_value)
    {
        return PoleLight::wherePoleId(Pole::whereUserId(Auth::user()->id)->first(['id'])->id)->first([$fetchData]);

    }

    /**
     * To retrieve pole_last_update_status
     * level
     */
    public function pole_last_update_status()
    {
        if (Auth::user()) {
            $pole_brightness = PoleLastState::wherePoleId(Pole::whereUserId(Auth::user()->id)->first(['id'])->id)->first(['change_value_code'])->change_value_code;

            if ($pole_brightness) {
//                $data = $pole_brightness->change_value_code;

                $this->return_response_pole($this->pole_brightness_data_value, $pole_brightness);
            } else {
                $this->return_response_pole($this->pole_fail_data_value, "Fail Response");
            }
        } else {
            $this->return_response_pole($this->pole_fail_data_value, "Un-Authorize Access");
        }
    }

    public function edit_pole_day_data(Request $request)
    {
        $rules = [
            'pole_id' => 'required',
            'mon_on' => 'required',
            'mon_off' => 'required',
            'tue_on' => 'required',
            'tue_off' => 'required',
            'wed_on' => 'required',
            'wed_off' => 'required',
            'thu_on' => 'required',
            'thu_off' => 'required',
            'fri_on' => 'required',
            'fri_off' => 'required',
            'sat_on' => 'required',
            'sat_off' => 'required',
            'sun_on' => 'required',
            'sun_off' => 'required',
        ];

        $attribute = null;
        $values = null;

        if ($this->ApiValidator($request->all(), $rules)) {
            try {
                $pole_id = $request->pole_id;

                if ($request->has('id')) {
                    $attribute['id'] = $request->id;
                }

                $value = array();
                $value['pole_id'] = $pole_id;
                $value['mon_on'] = $request->mon_on;
                $value['mon_off'] = $request->mon_off;
                $value['tue_on'] = $request->tue_on;
                $value['tue_off'] = $request->tue_off;
                $value['wed_on'] = $request->wed_on;
                $value['wed_off'] = $request->wed_off;
                $value['thu_on'] = $request->thu_on;
                $value['thu_off'] = $request->thu_off;
                $value['fri_on'] = $request->fri_on;
                $value['fri_off'] = $request->fri_off;
                $value['sat_on'] = $request->sat_on;
                $value['sat_off'] = $request->sat_off;
                $value['sun_on'] = $request->sun_on;
                $value['sun_off'] = $request->sun_off;

                if ($attribute) {
                    $value['updated_by'] = Auth::user()->id;

                    $pole_day_data = PoleDayData::updateOrCreate($attribute, $value);
                    $createOrUpdate = 'Update';
                } else {
                    $value['created_by'] = Auth::user()->id;
                    $value['updated_by'] = Auth::user()->id;

                    $pole_day_data = PoleDayData::create($value);
                    $createOrUpdate = 'Create';
                }

                if ($pole_day_data) {
                    $this->set_return_response_success($pole_day_data, "Pole Day Data " . $createOrUpdate . "d Successfully.");
                } else {
                    $this->set_return_response_unsuccessful("Pole Day Data $createOrUpdate has some issue please try again.");
                }
            } catch (Exception $exception) {
                $this->set_return_response_exception($exception);
            }
        }

        return $this->return_response();
    }
}
