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
//    Route::view('/leave', '/hrms.leave.apply_leave')->name('leave');
//    Route::view('/leave', '/hrms.leave.show_my_leave')->name('leave');


    Route::get('/user_employee', [UserEmployeeController::class, 'index'])->name('UsersList');
    Route::get('/attendance-list-emp', [AttendanceController::class, 'empAttendanceListView'])->name('attendance-list-emp');
    Route::get('/attendance-list-my', [AttendanceController::class, 'myAttendanceListView'])->name('attendance-list-my');
    Route::get('/att_view/{id}', [AttendanceController::class, 'att_view'])->name('att_view');

    Route::get('/leave-type-list', [LeaveController::class, 'typeLeaveListView'])->name('leave-type-list');
    Route::get('/leave-list-my', [LeaveController::class, 'myLeaveListView'])->name('leave-list-my');
    Route::get('/leave-list-emp', [LeaveController::class, 'empLeaveListView'])->name('leave-list-emp');

    /*
     * HRMS Forms --Start
    */
    Route::get('/leave-type-edit', [LeaveController::class, 'editLeaveTypeView'])->name('leave-type-edit');
    Route::get('/leave-type-store', [LeaveController::class, 'storeLeaveTypeView'])->name('leave-type-store');

    /*Leave Form*/
    Route::get('/leave-apply', [LeaveController::class, 'applyLeaveFormCreate'])->name('leave-apply');
    Route::post('/leave-store', [LeaveController::class, 'applyLeaveFormStore'])->name('leave-store');

    /*User Role Form*/
    Route::get('/user-role-edit', [UserRoleController::class, 'create'])->name('user-role-edit');
    Route::post('/user-role-store', [UserRoleController::class, 'store'])->name('user-role-store');

    /*Employee Forms*/
    Route::get('/emp-registration-att-edit', [UserEmployeeController::class, 'empRegistrationForAttFormCreate'])->name('emp-registration-att-edit');
    Route::post('/emp-registration-att-store', [UserEmployeeController::class, 'empRegistrationForAttFormStore'])->name('emp-registration-att-store');

    Route::get('/generate_pdf', [LeaveController::class, 'generate_pdf'])->name('generate_pdf');

    //HRMS Forms --End
});
