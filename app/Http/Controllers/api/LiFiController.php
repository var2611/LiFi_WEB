<?php


namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;
use App\Models\LedLight;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LiFiController extends Controller
{
    public function led_update(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
            'status' => 'required',
            'brightness' => 'required',
        ];

        if ($this->ApiValidator($request->all(), $rules)) {

            $attribute = null;
            $values = null;
            $id = null;

            if ($request['id'] ?? null) {
                $attribute['id'] = $request['id'];
                $id = $request['id'];
            }

            $values['status'] = $request['status'];
            $status = $request['status'];
            $values['brightness'] = $request['brightness'];
            $brightness = $request['brightness'];

            if ($attribute) {
                $led_light = LedLight::whereId($id)->first();
                $led_light->status = $status;
                $led_light->brightness = $brightness;
                $led_light->save();

                $createOrUpdate = 'Update';
            }

            if ($led_light) {
                $this->set_return_response_success($led_light, "Led Light " . $createOrUpdate . "d Successfully.");
            } else {
                $this->set_return_response_unsuccessful("Led Light $createOrUpdate has some issue please try again.");
            }

        }
        return $this->return_response();
    }

    public function led_brightness_status(Request $request)
    {
        $rules = [
            'id' => 'required',
        ];

        if ($this->ApiValidator($request->all(), $rules)) {
            $brightness = LedLight::whereId($request['id'])->first('brightness');

            if ($brightness) {
                echo $brightness->brightness;
//                $this->set_return_response_success($brightness, "Led Light Brightness Fetched Successfully.");
            } else {
                echo "Error!!";
//                $this->set_return_response_unsuccessful("Led Light Brightness has some issue please try again.");
            }
        }
//        return $this->return_response();
    }

    public function led_status(Request $request)
    {
        $rules = [
            'id' => 'required',
        ];

        if ($this->ApiValidator($request->all(), $rules)) {
            $status = LedLight::whereId($request['id'])->first('status');

            if ($status) {
                echo $status->status;
//                $this->set_return_response_success($status, "Led Light status Fetched Successfully.");
            } else {
                echo "Error!!";
//                $this->set_return_response_unsuccessful("Led Light status has some issue please try again.");
            }
        }
//        return $this->return_response();
    }
}
