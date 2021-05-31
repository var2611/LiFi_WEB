<?php

use App\Http\Controllers\api\attendance\LiFiAttendanceController;
use App\Http\Controllers\api\pole\LiFiPoleController;
use App\Http\Controllers\api\pole\PoleController;
use App\Http\Controllers\api\TestController;
use App\Http\Controllers\api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
 * LiFi Led Test API Start
 * */

Route::get('ledUpdate', [LiFiPoleController::class, 'led_update']);
Route::get('getLedBrightnessStatus', [LiFiPoleController::class, 'led_brightness_status']);
Route::get('getLedStatus', [LiFiPoleController::class, 'led_status']);

Route::post('poleLogin', [PoleController::class, 'login']);
Route::post('poleTime', [PoleController::class, 'getCurrentTime']);


/*
 * LiFi Led Test API End
 * */


Route::post('demo1', [UserController::class, 'demo1']);
Route::post('createUser', [UserController::class, 'createUser']);
Route::post('createUser1', [UserController::class, 'createUser1']);
Route::post('smsToMobile', [UserController::class, 'smsToMobile']);
Route::get('new_mail', [TestController::class, 'new_mail']);
Route::get('demoV', [TestController::class, 'demoV']);

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

/*
 * Start LiFi LiFi Attendance API
 * */

Route::post('att/login', [LiFiAttendanceController::class, 'login']);

/*
 * End LiFi LiFi Attendance API
 * */

/*
 * Start Android LiFi Attendance API
 * */

Route::post('att/checkUserRegistration', [UserController::class, 'att_check_user_registration']);

/*
 * End Android LiFi Attendance API
 * */

//Route::post('demo1', 'UserController@demo1');


Route::group(['middleware' => 'auth:api'], function () {
    Route::post('userDetails', [UserController::class, 'user_details']);

    Route::post('poleMain', [PoleController::class, 'poleMain']);
    Route::get('poleLastUpdateStatus', [PoleController::class, 'pole_last_update_status']);

    //POLE Application API
    Route::get('editPoleDayData', [PoleController::class, 'edit_pole_day_data']);

    //LiFi Attendance API
    Route::post('att/saveAtt', [LiFiAttendanceController::class, 'saveAttendance']);
    Route::post('att/userDetails', [UserController::class, 'att_user_details']);
    Route::post('att/attRegisterEmployee', [UserController::class, 'att_register_employee']);


});
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
