<?php

use App\Http\Controllers\api\LiFiController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\TestController;
use Illuminate\Http\Request;
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

Route::get('ledUpdate', [LiFiController::class, 'led_update']);
Route::get('getLedBrightnessStatus', [LiFiController::class, 'led_brightness_status']);
Route::get('getLedStatus', [LiFiController::class, 'led_status']);
Route::get('new_mail', [TestController::class, 'new_mail']);

/*
 * LiFi Led Test API End
 * */

Route::post('demo1', [UserController::class, 'demo1']);
Route::post('createUser', [UserController::class, 'createUser']);
Route::post('createUser1', [UserController::class, 'createUser1']);
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('smsToMobile', [UserController::class, 'smsToMobile']);

//Route::post('demo1', 'UserController@demo1');


Route::group(['middleware' => 'auth:api'], function () {
    Route::post('userDetails', [UserController::class, 'user_details']);

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
