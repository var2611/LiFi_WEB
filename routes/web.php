<?php

use App\Http\Controllers\web\AttendanceController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\LeaveController;
use App\Http\Controllers\web\UserEmployeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/login');
//Route::redirect('/home', '/admin');
Auth::routes();

Route::view('/dashboard', '/dashboard')->name('dashboard');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');


    Route::view('/dashboard', '/hrms.dashboard')->name('hr_dashboard');
    Route::view('/welcome', '/hrms.welcome')->name('hr_welcome');
    Route::get('/user_employee', [UserEmployeeController::class, 'index'])->name('UsersList');
    Route::get('/user_attendance', [AttendanceController::class, 'index'])->name('UsersAtt');
    Route::get('/att_view/{id}', [AttendanceController::class, 'att_view'])->name('att_view');

    Route::get('/leave', [LeaveController::class, 'doApply']);
    Route::get('/leave-type', [LeaveController::class, 'showLeaveType'])->name('leave-type');

    Route::get('/leave-apply', [LeaveController::class, 'create'])->name('leave-apply');
    Route::post('/leave-store', [LeaveController::class, 'store'])->name('leave-store');
});
