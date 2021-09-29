<?php

use App\Http\Controllers\web\AttendanceController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\LeaveController;
use App\Http\Controllers\web\SalaryController;
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
Route::view('/demo_table', '/demo_table')->name('demo_table');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/demo', [HomeController::class, 'demo'])->name('demo');

    Route::view('/dashboard', '/hrms.dashboard')->name('hr_dashboard');
    Route::view('/welcome', '/hrms.welcome')->name('hr_welcome');

    Route::get('/user_employee', [UserEmployeeController::class, 'index'])->name('UsersList');
    Route::get('/attendance-list-emp', [AttendanceController::class, 'empAttendanceListView'])->name('attendance-list-emp');
    Route::get('/attendance-list-my', [AttendanceController::class, 'myAttendanceListView'])->name('attendance-list-my');

    Route::get('/att_view/{id}', [AttendanceController::class, 'att_view'])->name('att_view');

    Route::get('/leave-type-list', [LeaveController::class, 'typeLeaveListView'])->name('leave-type-list');
    Route::get('/leave-list-my', [LeaveController::class, 'myLeaveListView'])->name('leave-list-my');
    Route::get('/leave-list-emp', [LeaveController::class, 'empLeaveListView'])->name('leave-list-emp');



    /*HRMS Forms --Start*/

    Route::get('/leave-type-edit/{id?}', [LeaveController::class, 'leaveTypeCreate'])->name('leave-type-edit');
    Route::post('/leave-type-store', [LeaveController::class, 'leaveTypeStore'])->name('leave-type-store');

    /*Leave Form*/
    Route::get('/leave-apply', [LeaveController::class, 'applyLeaveFormCreate'])->name('leave-apply');
    Route::post('/leave-store', [LeaveController::class, 'applyLeaveFormStore'])->name('leave-store');

    /*User Role Form*/
    Route::get('/user-role-edit/{id?}', [UserRoleController::class, 'create'])->name('user-role-edit');
    Route::post('/user-role-store', [UserRoleController::class, 'store'])->name('user-role-store');

    /*Employee Forms*/
    Route::get('/emp-registration-att-edit', [UserEmployeeController::class, 'empRegistrationForAttFormCreate'])->name('emp-registration-att-edit');
    Route::post('/emp-registration-att-store', [UserEmployeeController::class, 'empRegistrationForAttFormStore'])->name('emp-registration-att-store');

    /*Employee Bank Detail Forms*/
    Route::get('/emp-bank-detail-edit/{id}', [UserEmployeeController::class, 'empBankDetailFormCreate'])->name('emp-bank-detail-edit');
    Route::post('/emp-bank-detail-store', [UserEmployeeController::class, 'empBankDetailFormStore'])->name('emp-bank-detail-store');

    /*Employee Contract Amount Type Forms*/
    Route::get('/emp-contract-amount-type-edit/{id?}', [UserEmployeeController::class, 'empContractAmountTypeFormCreate'])->name('emp-contract-amount-type-edit');
    Route::post('/emp-contract-amount-type-store', [UserEmployeeController::class, 'empContractAmountTypeFormStore'])->name('emp-contract-amount-type-store');

    /*Employee Department Type Forms*/
    Route::get('/emp-department-type-edit/{id?}', [UserEmployeeController::class, 'empDepartmentTypeFormCreate'])->name('emp-department-type-edit');
    Route::post('/emp-department-type-store', [UserEmployeeController::class, 'empDepartmentTypeFormStore'])->name('emp-department-type-store');

    /*Over Time Type Forms*/
    Route::get('/over-time-type-edit/{id?}', [SalaryController::class, 'overTimeTypeCreate'])->name('over-time-type-edit');
    Route::post('/over-time-type-store', [SalaryController::class, 'overTimeTypeStore'])->name('over-time-type-store');

    /*Salary Allowance Type Forms*/
    Route::get('/salary-allowance-type-edit/{id?}', [SalaryController::class, 'salaryAllowanceTypeCreate'])->name('salary-allowance-type-edit');
    Route::post('/salary-allowance-type-store', [SalaryController::class, 'salaryAllowanceTypeStore'])->name('salary-allowance-type-store');

    Route::get('/generate_pdf', [LeaveController::class, 'generate_pdf'])->name('generate_pdf');

    //HRMS Forms --End
});
