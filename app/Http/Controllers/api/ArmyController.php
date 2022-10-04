<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserEmployee;
use App\Models\VehicleDriver;
use App\Models\VehicleUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArmyController extends Controller
{
    public function armyVehicleRegistration(Request $request): JsonResponse
    {
        $rules = [
            'vehicle_number' => 'required'
        ];

        $user = Auth::user();

        if ($this->ApiValidator($request->all(), $rules) && $user->isArmy()) {
            $vehicle_number = $request->vehicle_number;

            $vehicle = User::whereMobile($vehicle_number)->first();

            if ($vehicle) {

                $alreadyRegisteredVehicle = VehicleUser::whereVehicleId($vehicle->id)->whereIsActive(0)->first();

                $assignVehicle = false;

                if ($alreadyRegisteredVehicle) {
                    if ($alreadyRegisteredVehicle->user_id == $user->id) {
                        $this->set_return_response_unsuccessful("Vehicle is already assigned to your account.");
                    } else {
                        $alreadyRegisteredVehicle->is_active = 1;
                        $alreadyRegisteredVehicle->end_time = getTodayDateTime();
                        $alreadyRegisteredVehicle->save();
                        $assignVehicle = true;
                    }
                } else {
                    $assignVehicle = true;
                }

                if ($assignVehicle) {
                    $vehicle_user = new VehicleUser();
                    $vehicle_user->user_id = $user->id;
                    $vehicle_user->vehicle_id = $vehicle->id;
                    $vehicle_user->start_time = getTodayDateTime();
                    $result = $vehicle_user->save();

                    if ($result) {
                        $this->set_return_response_success(null, "Vehicle User Registration Successful.");
                    } else {
                        $this->set_return_response_unsuccessful("Vehicle Registration has failed, Please try again.");
                    }
                }

            } else {
                $this->set_return_response_unsuccessful("Provided vehicle Number is not registered in system.");
            }
        }

        return $this->return_response();
    }


    public function getRegisteredVehicleList(Request $request): JsonResponse
    {
        $rules = [
//            'vehicle_number' => 'required'
        ];

        $user = Auth::user();

        if ($this->ApiValidator($request->all(), $rules) && $user->isArmy()) {
            $vehicleUsers = VehicleUser::whereUserId($user->id)
                ->with(['Vehicle:id,name,mobile'])
                ->get(['id', 'user_id', 'vehicle_id', 'start_time', 'end_time', 'is_active']);
            if ($vehicleUsers) {
                $data["vehicles"] = $vehicleUsers;
                $this->set_return_response_success($data, "Vehicle User List.");
            } else {
                $this->set_return_response_unsuccessful("No Record Found.");
            }
        }
        return $this->return_response();
    }


    public function armyGateVerification(Request $request)
    {
        $rules = [
            'flash_code' => 'required',
        ];

        if ($this->ApiValidator($request->all(), $rules)) {
            $flash_code = $request->flash_code;

            $vehicle = UserEmployee::whereFlashCode($flash_code)
                ->with(['User:id,mobile'])
                ->first();

//            dd($vehicle);

            if ($vehicle) {
                $driver = VehicleDriver::whereVehicleId($vehicle->user_id)
                    ->whereIsActive(0)
                    ->with(['Driver:id,name'])
                    ->first();

                if ($driver) {

                    $passenger = VehicleUser::whereVehicleId($vehicle->user_id)
                        ->whereIsActive(0)
                        ->with(['User:id,name'])
                        ->first();

                    if ($passenger) {
                        $this->return_response_att("1,Vehicle No." . $vehicle->User->mobile . ",Driver : " . $driver->Driver->getFullName() . ",Name : " . $passenger->User->getFullName());

                    } else {
                        $this->return_response_att_error("No Passenger is assigned to this Vehicle.");
                    }
                } else {
                    $this->return_response_att_error("No Driver is assigned to this Vehicle.");
                }
            } else {
                $this->return_response_att_error("No User Found.");
            }
        }
    }
}
