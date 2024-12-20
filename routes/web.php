<?php

use App\Http\Controllers\web\ArmyController;
use App\Http\Controllers\web\AttendanceController;
use App\Http\Controllers\web\ConfigController;
use App\Http\Controllers\web\EmployeeContractController;
use App\Http\Controllers\web\EmployeeWorkShiftController;
use App\Http\Controllers\web\ExportController;
use App\Http\Controllers\web\FreeLifiWifiController;
use App\Http\Controllers\web\HolidayController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\ImportController;
use App\Http\Controllers\web\LatLongInternetController;
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
Route::get('/clear/route', [ConfigController::class, 'clearRoute'])->name('clearRoute');

//Route::redirect('/home', '/admin');
/*Employee IdCard*/
Route::get('/emp/{id}', [UserEmployeeController::class, 'getEmployeeIdCard'])->name('get-emp-id-card');

Auth::routes();

//Route::view('/dashboard', '/dashboard')->name('dashboard');
Route::view('/demo_table', '/hrms.component.salary.data-attendance-overtime')->name('demo_table');
Route::get('/fetchPublicWiFiData', [FreeLifiWifiController::class, 'fetchPublicWiFiData'])->name('fetchPublicWiFiData');
Route::get('/demoA/{id?}', [SalaryController::class, 'editSalary'])->name('demoA');
Route::view('/salary-slip', '/layouts.salary-slip-demo')->name('salary-slip');

Route::get('/test', [LatLongInternetController::class, 'test'])->name('test');

Route::group(['middleware' => 'auth'], function () {
    Route::view('/main-test', '/layouts.main_test')->name('main-test');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/demo', [HomeController::class, 'demo'])->name('demo');

    Route::view('/dashboard', '/hrms.dashboard')->name('hr_dashboard');
    Route::get('/welcome', [HomeController::class, 'welcome'])->name('welcome');

    Route::get('/view-att-detail/{id}', [AttendanceController::class, 'view_att_detail'])->name('view-att-detail');

    Route::get('/generate-salary/', [SalaryController::class, 'viewGenerateSalary'])->name('generate-salary');
    Route::post('/calculate-salary/', [SalaryController::class, 'calculateSalary'])->name('calculate-salary');
    Route::get('/salary-slip/{id}', [SalaryController::class, 'salaryView'])->name('salary-slip');

    /*HRMS Forms --Start------------------------------------------------------------------*/

    Route::get('import-status', [ImportController::class, 'status']);
    Route::get('import-helper-view', [ImportController::class, 'importHelperForm']);
    Route::post('import-helper-data', [ImportController::class, 'importHelperData'])->name('import-helper-data');


    Route::get('/sheet-import-emp-attendance-upload', [ImportController::class, 'importEmployeesAttendanceForm'])->name('sheet-import-emp-attendance-upload');
    Route::post('generate-emp-attendances', [ImportController::class, 'generateEmpAndAttendanceFromAttendanceSheet'])->name('generate-emp-attendances');

    Route::get('/sheet-import-emp-contracts', [ImportController::class, 'importEmployeesContractForm'])->name('sheet-import-emp-contracts');
    Route::post('generate-emp-contracts', [ImportController::class, 'generateEmpContractsFromSalarySheet'])->name('generate-emp-contracts');

    Route::get('/sheet-import-lat-long-data', [ImportController::class, 'importLatLongDataForm'])->name('sheet-import-lat-long-data');
    Route::post('/generate-lat-long-data', [ImportController::class, 'generateLatLongData'])->name('generate-lat-long-data');

    Route::get('/sheet-export-salary-form', [ExportController::class, 'sheetExportSalaryForm'])->name('sheet-export-salary-form');
    Route::post('/sheet-export-salary-download', [ExportController::class, 'sheetExportSalaryDownload'])->name('sheet-export-salary-download');

    Route::get('/pdf-export-salary-slip-form', [ExportController::class, 'pdfExportSalarySlipForm'])->name('pdf-export-salary-slip-form');
    Route::post('/pdf-export-salary-slip-download', [ExportController::class, 'pdfExportSalarySlipDownload'])->name('pdf-export-salary-slip-download');

    Route::get('/pdf-export-attendance-form', [ExportController::class, 'pdfExportAttendanceForm'])->name('pdf-export-attendance-form');
    Route::post('/pdf-export-attendance-download', [ExportController::class, 'pdfExportAttendanceDownload'])->name('pdf-export-attendance-download');

    Route::get('/edit-leave-type/{id?}', [LeaveController::class, 'editFormLeaveType'])->name('edit-leave-type');
    Route::post('/store-leave-type', [LeaveController::class, 'storeFormLeaveType'])->name('store-leave-type');

    /*Work Shift Form*/
    Route::get('/edit-work-shift/{id}', [EmployeeWorkShiftController::class, 'editFormWorkShift'])->name('edit-work-shift');
    Route::post('/store-work-shift', [EmployeeWorkShiftController::class, 'storeFormWorkShift'])->name('store-work-shift');

    /*Leave Form*/
    Route::get('/edit-leave-apply', [LeaveController::class, 'editFormApplyLeave'])->name('edit-leave-apply');
    Route::post('/store-leave', [LeaveController::class, 'storeFormApplyLeave'])->name('store-leave');

    /*User Role Form*/
    Route::get('/edit-user-role/{id?}', [UserEmployeeController::class, 'editFormUserRole'])->name('edit-user-role');
    Route::post('/store-user-role', [UserEmployeeController::class, 'storeFormUserRole'])->name('store-user-role');

    /*Employee Forms*/
    Route::get('/edit-emp-registration-att/{id?}', [UserEmployeeController::class, 'editFormEmpRegistrationForAtt'])->name('edit-emp-registration-att');
    Route::post('/store-emp-registration-att', [UserEmployeeController::class, 'storeFormEmpRegistrationForAtt'])->name('store-emp-registration-att');


    /*Vehicle Forms*/
    Route::get('/edit-vehicle-registration-army', [ArmyController::class, 'editFormVehicleRegistrationForArmy'])->name('edit-vehicle-registration-army');
    Route::post('/store-vehicle-registration-army', [ArmyController::class, 'storeFormVehicleRegistrationForArmy'])->name('store-vehicle-registration-army');

    /*Employee Registration Forms*/
    Route::get('/edit-emp-registration', [UserEmployeeController::class, 'editFormEmpRegistration'])->name('edit-emp-registration');
    Route::post('/store-emp-registration', [UserEmployeeController::class, 'storeFormEmpRegistration'])->name('store-emp-registration');

    /*Employee Bank Detail Forms*/
    Route::get('/edit-emp-bank-detail/{id}', [UserEmployeeController::class, 'editFormEmpBankDetail'])->name('edit-emp-bank-detail');
    Route::post('/store-emp-bank-detail', [UserEmployeeController::class, 'storeFormEmpBankDetail'])->name('store-emp-bank-detail');

    /*Employee PF Detail Forms*/
    Route::get('/edit-emp-pf-detail/{id}', [UserEmployeeController::class, 'editFormEmpPFDetail'])->name('edit-emp-pf-detail');
    Route::post('/store-emp-pf-detail', [UserEmployeeController::class, 'storeFormEmpPFDetail'])->name('store-emp-pf-detail');

    /*Employee Contract Forms*/
    Route::get('/edit-emp-contract-type-list', [EmployeeContractController::class, 'empContractTypeListFormCreate'])->name('edit-emp-contract-type-list');
    Route::get('/edit-emp-contract/{id?}/{user_id?}', [EmployeeContractController::class, 'editFormEmpContract'])->name('edit-emp-contract');
    Route::post('/store-emp-contract', [EmployeeContractController::class, 'storeFormEmpContract'])->name('store-emp-contract');

    /*Employee Contract Forms*/
    Route::get('/edit-contract-type/{id?}', [EmployeeContractController::class, 'editFormContractType'])->name('edit-contract-type');
    Route::post('/store-contract-type', [EmployeeContractController::class, 'storeFormContractType'])->name('store-contract-type');

    /*Employee Contract Amount Type Forms*/
    Route::get('/edit-emp-contract-amount-type/{id?}', [UserEmployeeController::class, 'editFormEmpContractAmountType'])->name('edit-emp-contract-amount-type');
    Route::post('/store-emp-contract-amount-type', [UserEmployeeController::class, 'storeFormEmpContractAmountType'])->name('store-emp-contract-amount-type');

    /*Employee Contract Status Forms*/
    Route::get('/edit-emp-contract-status/{id?}', [EmployeeContractController::class, 'editFormEmpContractStatus'])->name('edit-emp-contract-status');
    Route::post('/store-emp-contract-status', [EmployeeContractController::class, 'storeFormEmpContractStatus'])->name('store-emp-contract-status');

    /*Employee Department Type Forms*/
    Route::get('/edit-emp-department-type/{id?}', [UserEmployeeController::class, 'editFormEmpDepartmentType'])->name('edit-emp-department-type');
    Route::post('/store-emp-department-type', [UserEmployeeController::class, 'storeFormEmpDepartmentType'])->name('store-emp-department-type');

    /*Employee Department Type Forms*/
    Route::get('/edit-emp-department-data/{id?}', [UserEmployeeController::class, 'editFormEmpDepartmentData'])->name('edit-emp-department-data');
    Route::post('/store-emp-department-data', [UserEmployeeController::class, 'storeFormEmpDepartmentData'])->name('store-emp-department-data');

    /*Over Time Type Forms*/
    Route::get('/edit-overtime-type/{id?}', [SalaryController::class, 'editFormOvertimeType'])->name('edit-overtime-type');
    Route::post('/store-overtime-type', [SalaryController::class, 'storeFormOvertimeType'])->name('store-overtime-type');

    /*Salary Allowance Type Forms*/
    Route::get('/edit-salary-allowance-type/{id?}', [SalaryController::class, 'editFormSalaryAllowanceType'])->name('edit-salary-allowance-type');
    Route::post('/store-salary-allowance-type', [SalaryController::class, 'storeFormSalaryAllowanceType'])->name('store-salary-allowance-type');

    /*Salary Forms*/
    Route::get('/view-salary/{id?}', [SalaryController::class, 'viewSalary'])->name('view-salary');
    Route::get('/edit-salary/{id?}', [SalaryController::class, 'editSalary'])->name('edit-salary');
    Route::post('/store-salary', [SalaryController::class, 'storeSalary'])->name('store-salary');

    /*Salary Forms*/
    Route::get('/edit-free-lifi-wifi-file', [FreeLifiWifiController::class, 'freeLiFiWiFiFileCreate'])->name('edit-free-lifi-wifi-file');
    Route::post('/store-free-lifi-wifi-file', [FreeLifiWifiController::class, 'freeLiFiWiFiFileStore'])->name('store-free-lifi-wifi-file');

    /*Import Salary Forms*/
    Route::get('/edit-holiday', [HolidayController::class, 'editFormHoliday'])->name('edit-holiday');
    Route::post('/store-holiday', [HolidayController::class, 'storeFormHoliday'])->name('store-holiday');

//    Route::get('/generate_pdf', [LeaveController::class, 'generate_pdf'])->name('generate_pdf');
    Route::get('/edit-user-profile/{id}', [UserEmployeeController::class, 'editUserProfile'])->name('edit-user-profile');
    Route::get('/edit-army-profile/{id}', [ArmyController::class, 'editArmyProfile'])->name('edit-army-profile');
    Route::get('/edit-army-vehicle-profile/{id}', [ArmyController::class, 'editArmyVehicleProfile'])->name('edit-army-vehicle-profile');
    Route::post('/store-vehicle-modification', [ArmyController::class, 'storeFormVehicleModification'])->name('store-vehicle-modification');

    /*HRMS Forms --End------------------------------------------------------------------*/

    /*HRMS List --Start------------------------------------------------------------------*/

    Route::get('/list-employee', [UserEmployeeController::class, 'listEmp'])->name('list-employee');
    Route::get('/list-vehicle', [ArmyController::class, 'listVehicle'])->name('list-vehicle');
    Route::get('/list-role', [UserEmployeeController::class, 'listUserRoles'])->name('list-role');
    Route::get('/list-emp-attendance', [AttendanceController::class, 'listEmpAttendances'])->name('list-emp-attendance');
    Route::get('/list-my-attendance', [AttendanceController::class, 'listMyAttendances'])->name('list-my-attendance');
    Route::get('/list-emp-contract', [EmployeeContractController::class, 'listEmpContractView'])->name('list-emp-contract');
    Route::get('/list-contract-type', [EmployeeContractController::class, 'listContractTypeView'])->name('list-contract-type');
    Route::get('/list-emp-contract-status', [EmployeeContractController::class, 'listEmpContractStatusView'])->name('list-emp-contract-status');
    Route::get('/list-contract-amount-type', [EmployeeContractController::class, 'listEmpContractAmountTypeView'])->name('list-contract-amount-type');
    Route::get('/list-free-lifi-wifi-file', [FreeLifiWifiController::class, 'index'])->name('list-free-lifi-wifi-file');
    Route::get('/list-holiday', [HolidayController::class, 'listHoliday'])->name('list-holiday');
    Route::get('/list-leave-type', [LeaveController::class, 'listLeaveTypeView'])->name('list-leave-type');
    Route::get('/list-leave-my', [LeaveController::class, 'listLeaveMyView'])->name('list-leave-my');
    Route::get('/list-leave-emp', [LeaveController::class, 'listLeaveEmpView'])->name('list-leave-emp');
    Route::get('/list-salary', [SalaryController::class, 'salaryList'])->name('list-salary');
    Route::get('/list-salary-allowance-type', [SalaryController::class, 'salaryAllowanceTypeList'])->name('list-salary-allowance-type');
    Route::get('/list-overtime-type', [SalaryController::class, 'overtimeTypeList'])->name('list-overtime-type');
    Route::get('/list-emp-work-shift', [EmployeeWorkShiftController::class, 'listEmpWorkShiftView'])->name('list-emp-work-shift');
    Route::get('/lat-long-non-internet-data', [LatLongInternetController::class, 'listLatLongNonInternetData'])->name('lat-long-non-internet-data');
    Route::get('/army-dashboard', [ArmyController::class, 'index'])->name('army-dashboard');

    /*HRMS List --End------------------------------------------------------------------*/

    Route::get('/sheet-export-lat-long-data-download', [LatLongInternetController::class, 'listLatLongFilterDataExport'])->name('sheet-export-lat-long-data-download');
});
