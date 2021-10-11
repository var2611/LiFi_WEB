<?php

use App\Http\Controllers\web\AttendanceController;
use App\Http\Controllers\web\EmployeeContractController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\LeaveController;
use App\Http\Controllers\web\SalaryController;
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
Route::view('/demo_table', '/demo_table')->name('demo_table');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/demo', [HomeController::class, 'demo'])->name('demo');

    Route::view('/dashboard', '/hrms.dashboard')->name('hr_dashboard');
    Route::view('/welcome', '/hrms.welcome')->name('hr_welcome');

    Route::get('/list-employee', [UserEmployeeController::class, 'empList'])->name('list-employee');
    Route::get('/list-role', [UserEmployeeController::class, 'userRoleList'])->name('list-role');
    Route::get('/attendance-list-emp', [AttendanceController::class, 'empAttendanceListView'])->name('attendance-list-emp');
    Route::get('/attendance-list-my', [AttendanceController::class, 'myAttendanceListView'])->name('attendance-list-my');

    Route::get('/att_view/{id}', [AttendanceController::class, 'att_view'])->name('att_view');

    Route::get('/list-leave-type', [LeaveController::class, 'listLeaveTypeView'])->name('list-leave-type');
    Route::get('/list-leave-my', [LeaveController::class, 'listLeaveMyView'])->name('list-leave-my');
    Route::get('/list-leave-emp', [LeaveController::class, 'listLeaveEmpView'])->name('list-leave-emp');

    Route::get('/list-salary-allowance-type', [SalaryController::class, 'salaryAllowanceTypeList'])->name('list-salary-allowance-type');
    Route::get('/list-overtime-type', [SalaryController::class, 'overtimeTypeList'])->name('list-overtime-type');

    Route::get('/list-emp-contract', [EmployeeContractController::class, 'listEmpContractView'])->name('list-emp-contract');
    Route::get('/list-contract-type', [EmployeeContractController::class, 'listContractTypeView'])->name('list-contract-type');
    Route::get('/list-emp-contract-status', [EmployeeContractController::class, 'listEmpContractStatusView'])->name('list-emp-contract-status');
    Route::get('/list-contract-amount-type', [EmployeeContractController::class, 'listEmpContractAmountTypeView'])->name('list-contract-amount-type');


    /*HRMS Forms --Start*/

    Route::get('/leave-type-edit/{id?}', [LeaveController::class, 'leaveTypeCreate'])->name('leave-type-edit');
    Route::post('/leave-type-store', [LeaveController::class, 'leaveTypeStore'])->name('leave-type-store');

    /*Leave Form*/
    Route::get('/edit-leave-apply', [LeaveController::class, 'applyLeaveFormCreate'])->name('edit-leave-apply');
    Route::post('/leave-store', [LeaveController::class, 'applyLeaveFormStore'])->name('leave-store');

    /*User Role Form*/
    Route::get('/user-role-edit/{id?}', [UserEmployeeController::class, 'userRoleFormCreate'])->name('user-role-edit');
    Route::post('/user-role-store', [UserEmployeeController::class, 'userRoleFormStore'])->name('user-role-store');

    /*Employee Forms*/
    Route::get('/emp-registration-att-edit', [UserEmployeeController::class, 'empRegistrationForAttFormCreate'])->name('emp-registration-att-edit');
    Route::post('/emp-registration-att-store', [UserEmployeeController::class, 'empRegistrationForAttFormStore'])->name('emp-registration-att-store');

    /*Employee Registration Forms*/
    Route::get('/emp-registration-edit', [UserEmployeeController::class, 'empRegistrationFormCreate'])->name('emp-registration-edit');
    Route::post('/emp-registration-store', [UserEmployeeController::class, 'empRegistrationFormStore'])->name('emp-registration-store');

    /*Employee Bank Detail Forms*/
    Route::get('/emp-bank-detail-edit/{id}', [UserEmployeeController::class, 'empBankDetailFormCreate'])->name('emp-bank-detail-edit');
    Route::post('/emp-bank-detail-store', [UserEmployeeController::class, 'empBankDetailFormStore'])->name('emp-bank-detail-store');

    /*Employee PF Detail Forms*/
    Route::get('/emp-pf-detail-edit/{id}', [UserEmployeeController::class, 'empPFDetailFormCreate'])->name('emp-pf-detail-edit');
    Route::post('/emp-pf-detail-store', [UserEmployeeController::class, 'empPFDetailFormStore'])->name('emp-pf-detail-store');

    /*Employee Contract Forms*/
    Route::get('/emp-contract-edit/{id?}', [EmployeeContractController::class, 'empContractFormCreate'])->name('emp-contract-edit');
    Route::post('/emp-contract-store', [EmployeeContractController::class, 'empContractFormStore'])->name('emp-contract-store');


    /*Employee Contract Forms*/
    Route::get('/contract-type-edit/{id?}', [EmployeeContractController::class, 'contractTypeFormCreate'])->name('contract-type-edit');
    Route::post('/contract-type-store', [EmployeeContractController::class, 'contractTypeFormStore'])->name('contract-type-store');

    /*Employee Contract Amount Type Forms*/
    Route::get('/emp-contract-amount-type-edit/{id?}', [UserEmployeeController::class, 'empContractAmountTypeFormCreate'])->name('emp-contract-amount-type-edit');
    Route::post('/emp-contract-amount-type-store', [UserEmployeeController::class, 'empContractAmountTypeFormStore'])->name('emp-contract-amount-type-store');

    /*Employee Contract Status Forms*/
    Route::get('/emp-contract-status-edit/{id?}', [EmployeeContractController::class, 'empContractStatusFormCreate'])->name('emp-contract-status-edit');
    Route::post('/emp-contract-status-store', [EmployeeContractController::class, 'empContractStatusFormStore'])->name('emp-contract-status-store');

    /*Employee Department Type Forms*/
    Route::get('/emp-department-type-edit/{id?}', [UserEmployeeController::class, 'empDepartmentTypeFormCreate'])->name('emp-department-type-edit');
    Route::post('/emp-department-type-store', [UserEmployeeController::class, 'empDepartmentTypeFormStore'])->name('emp-department-type-store');

    /*Over Time Type Forms*/
    Route::get('/overtime-type-edit/{id?}', [SalaryController::class, 'overTimeTypeCreate'])->name('overtime-type-edit');
    Route::post('/overtime-type-store', [SalaryController::class, 'overTimeTypeStore'])->name('overtime-type-store');

    /*Salary Allowance Type Forms*/
    Route::get('/salary-allowance-type-edit/{id?}', [SalaryController::class, 'salaryAllowanceTypeCreate'])->name('salary-allowance-type-edit');
    Route::post('/salary-allowance-type-store', [SalaryController::class, 'salaryAllowanceTypeStore'])->name('salary-allowance-type-store');

    /*Salary Forms*/
    Route::get('/salary-edit/{id?}', [SalaryController::class, 'salaryCreate'])->name('salary-edit');
    Route::post('/salary-allowance-type-store', [SalaryController::class, 'salaryAllowanceTypeStore'])->name('salary-allowance-type-store');

//    Route::get('/generate_pdf', [LeaveController::class, 'generate_pdf'])->name('generate_pdf');
    Route::get('/edit-user-profile/{id}', [UserEmployeeController::class, 'editUserProfile'])->name('edit-user-profile');

    //HRMS Forms --End
});
