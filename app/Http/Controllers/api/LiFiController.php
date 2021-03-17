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

            if ($request['id'] ?? null) {
                $attribute['id'] = $request['id'];
            }

            $values['status'] = $request['status'];
            $values['brightness'] = $request['brightness'];

            if ($attribute) {
                $led_light = LedLight::updateOrCreate($values);

                $createOrUpdate = 'Update';
            } else {
                $led_light = LedLight::create($values);

                $createOrUpdate = 'Create';
            }

            if ($led_light) {
                $this->set_return_response_success($led_light, "Led Light " . $createOrUpdate . "d Successfully.");
            } else {
                $this->set_return_response_unsuccessful("Led Light $createOrUpdate has some issue please try again.");
            }

        }
        return $this->return_response();
    }

    public function led_brightness_status(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
        ];

        if ($this->ApiValidator($request->all(), $rules)) {
            $brightness = LedLight::whereId($request['id'])->first('brightness');

            if ($brightness) {
                $this->set_return_response_success($brightness, "Led Light Brightness Fetched Successfully.");
            } else {
                $this->set_return_response_unsuccessful("Led Light Brightness has some issue please try again.");
            }
        }
        return $this->return_response();
    }

    public function led_status(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
        ];

        if ($this->ApiValidator($request->all(), $rules)) {
            $brightness = LedLight::whereId($request['id'])->first('status');

            if ($brightness) {
                $this->set_return_response_success($brightness, "Led Light status Fetched Successfully.");
            } else {
                $this->set_return_response_unsuccessful("Led Light status has some issue please try again.");
            }
        }
        return $this->return_response();
    }
}
