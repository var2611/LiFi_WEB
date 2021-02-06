<?php

use App\Http\Controllers\api\UserController;
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

Route::post('demo', [UserController::class, 'demo']);
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);


Route::group(['middleware' => 'auth:api'], function () {
    Route::post('userDetails', [UserController::class, 'user_details']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
