<?php

use App\Http\Controllers\web\AttendanceController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\LeaveController;
use App\Http\Controllers\web\UserEmployeeController;
use App\Http\Controllers\web\UserRoleController;
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
    Route::get('/leave-list-type', [LeaveController::class, 'typeLeaveListView'])->name('leave-list-type');
    Route::get('/leave-list-my', [LeaveController::class, 'myLeaveListView'])->name('leave-list-my');
    Route::get('/leave-list-emp', [LeaveController::class, 'empLeaveListView'])->name('leave-list-emp');
    Route::get('/leave-type', [LeaveController::class, 'showLeaveType'])->name('leave-type');

    /*
     * HRMS Forms --Start
    */
    /*Leave Form*/
    Route::get('/leave-apply', [LeaveController::class, 'create'])->name('leave-apply');
    Route::post('/leave-store', [LeaveController::class, 'store'])->name('leave-store');
    /*User Role Form*/
    Route::get('/user-role-edit', [UserRoleController::class, 'create'])->name('user-role-edit');
    Route::post('/user-role-store', [UserRoleController::class, 'store'])->name('user-role-store');

    //HRMS Forms --End
});
