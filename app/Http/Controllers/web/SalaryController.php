<?php

namespace App\Http\Controllers\web;

use App\Forms\Salary\GenerateSalary;
use App\Forms\Salary\OverTimeTypeForm;
use App\Forms\Salary\SalaryAllowanceTypeForm;
use App\Forms\Salary\SalaryForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\DetailListSalaryView;
use App\Http\Livewire\ListOverTimeType;
use App\Http\Livewire\ListSalary;
use App\Http\Livewire\ListSalaryAllowanceType;
use App\Imports\ImportPaarthAttendanceAdd;
use App\Models\Attendance;
use App\Models\CompanyHrmsSetting;
use App\Models\EmpContract;
use App\Models\EmpContractAmountType;
use App\Models\EmpDepartmentType;
use App\Models\EmpPfDetail;
use App\Models\FormModels\DataSalaryEdit;
use App\Models\FormModels\DataSalarySlip;
use App\Models\ImportPublicWifiSeasonData;
use App\Models\OvertimeType;
use App\Models\Salary;
use App\Models\SalaryAllowanceType;
use App\Models\SalaryDetail;
use App\Models\SalaryPfDetail;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use LaravelViews\LaravelViews;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class SalaryController extends Controller
{
    public function editFormOvertimeType(string $id = null)
    {
        $model = new OvertimeType();
        return $this->createForm(
            OverTimeTypeForm::class,
            route('store-overtime-type'),
            'salary',
            $model,
            $id
        );
    }

    public function storeFormOvertimeType(): string
    {
        $model = new OvertimeType();
        return $this->formStore(OverTimeTypeForm::class, $model, 'list-overtime-type', 'salary', 'Over Time Type');
    }

    public function editFormSalaryAllowanceType(string $id = null)
    {
        $model = SalaryAllowanceType::whereId($id)->first();
        return $this->createForm(
            SalaryAllowanceTypeForm::class,
            route('store-salary-allowance-type'),
            'salary',
            $model,
            $id
        );
    }

    public function storeFormSalaryAllowanceType(): string
    {
        $model = new SalaryAllowanceType();
        return $this->formStore(SalaryAllowanceTypeForm::class, $model, 'list-salary-allowance-type', 'salary', 'Salary Allowance Type');
    }

    public function salaryAllowanceTypeList(LaravelViews $laravelViews, Request $request): string
    {
        return $this->createList($laravelViews, ListSalaryAllowanceType::class, 'Salary Allowance Type List', 'salary', route('edit-salary-allowance-type'));
    }

    public function salaryList(LaravelViews $laravelViews, Request $request): string
    {
        return $this->createList($laravelViews, ListSalary::class, 'Salary List', 'salary');
    }

    public function overtimeTypeList(LaravelViews $laravelViews, Request $request): string
    {
        return $this->createList($laravelViews, ListOverTimeType::class, 'Overtime Type List', 'salary', route('edit-overtime-type'));
    }

    public function editSalary(string $id = null)
    {
        $salary = Salary::whereId($id)->with(['SalaryDetail', 'UserEmployee:id,user_id,emp_code'])->first();

        $model = new DataSalaryEdit();
        $model->setSalaryData($salary);

        return $this->createForm(
            SalaryForm::class,
            route('store-salary'),
            'salary',
            $model,
            $id
        );
    }

    public function storeSalary(): RedirectResponse
    {

        $form = $this->form(SalaryForm::class);
        $form->redirectIfNotValid();

//        dd($form->getFieldValues());

        $model = new DataSalaryEdit();
        $model->setFormData($form->getFieldValues());
        $model->saveSalary();

        notify()->success("Salary Updated Successfully.");
        return redirect()->route('list-salary');
    }

    public function viewSalary(string $id, LaravelViews $laravelViews)
    {
        $salary = Salary::whereId($id)->first();

//        dd($salary);
        return view('main_detail', [
            'class' => DetailListSalaryView::getName(),
            'model' => $salary,
        ])->render();
    }

    public function viewGenerateSalary()
    {
        return $this->createForm(
            GenerateSalary::class,
            route('calculate-salary'),
            'salary'
        );
    }

    public function importSalaryStore()
    {
        $model = new ImportPublicWifiSeasonData();
//        $form = $this->formStoreData(ImportSalary::class);
        $form = $this->form(GenerateSalary::class);
        $form->redirectIfNotValid();

//        print_r($form->getFieldValues());
        if ($form->getRequest()->hasFile('salary_sheet')) {

            try {
                $file = $form->getRequest()->file('salary_sheet');
//                $import = Excel::import(new ImportPaarthAttendanceCreateUser(10, 2021, 4), $file);
                $import = Excel::import(new ImportPaarthAttendanceAdd(11, 2021), $file);
//                $import = Excel::import(new ImportParthSalarySheet(3, 4), $file);

//                (new ImportParthSalarySheet)->toCollection($file);

//                $heading = (new HeadingRowImport(2))->toArray($file);


//                echo json_encode($heading, JSON_PRETTY_PRINT);
                return redirect()->back();
            } catch (ValidationException $e) {
                $failures = $e->failures();

                echo json_encode($failures, JSON_PRETTY_PRINT);
            }

//            echo 'Success';
        } else {
//            echo 'Fail';
        }

    }

    public function calculateSalary()
    {
        $form = $this->form(GenerateSalary::class);
        $form->redirectIfNotValid();

        $formData = $this->formStoreData(GenerateSalary::class);
        $month = $formData['salary_month'];
        $year = $formData['salary_year'];

        $company_id = Auth::user()->getCompanyId();

        $company_setting_data = CompanyHrmsSetting::whereCompanyId($company_id)->first();
        $pf_percentage = $company_setting_data->pf_percentage;
        $emp_allowed_hours = $company_setting_data->description;

        $holidays = getHolidayDateOfCompanyByMonth($company_id, $month, $year);

        $date_today = getTodayDate();

        if (!validateSalaryGenerate($month, $year, $this)) {
            return redirect()->back();
        }

        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $sundays = getSundays($month, $year, $days_in_month);
        $monthly_off = array_unique(array_merge($holidays, $sundays));
        $working_days = $days_in_month - count($sundays);

        $emp_contract_list = EmpContract::with(['UserEmployee:id,user_id,company_id', 'EmpContractType:id,name,emp_contract_amount_type_id'])
            ->whereHas('UserEmployee', function ($q) use ($company_id) {
                $q->where('company_id', '=', $company_id);
            })
            ->whereRaw("CONCAT($month, $year) BETWEEN CONCAT(MONTH(`start_date`), YEAR(`start_date`)) AND CONCAT(MONTH(`end_date`), YEAR(`end_date`))");
//            ->whereYear('start_date', '=', $year);
//            ->orWhereYear('end_date', '=', $year);

//            ->orWhereMonth('end_date', '>=', $month)
//            ->whereYear('end_date', '>=', $year)
//            ->toSql();

        $emp_contract_count = $emp_contract_list->count('id');

        if ($emp_contract_count == 0) {
            $attendance_fail_message = 'There is no Employee Contract available for  Selected Month ' . getMonthNameFromMonthNumber($month) . ' ' . $year;

            $this->notifyMessage(false, $attendance_fail_message);
            return redirect()->back();
        }

//        dd($emp_contract_count);

        $emp_contract_list = $emp_contract_list->get(['id', 'user_id', 'name', 'hours', 'salary_basic', 'salary_hra', 'salary_total', 'emp_contract_type_id', 'emp_department_type_id']);

//        echo json_encode(($emp_contract_list)) . '<br>';
//        dd($emp_contract_list);
//        exit();


        $hourly = 'hourly';
        $daily = 'daily';
        $monthly = 'monthly';
        $other = 'other';

        $hourly_contract_amount_id = EmpContractAmountType::where('name', 'LIKE', '%' . $hourly . '%')->first(['id'])->id;
        $daily_contract_amount_id = EmpContractAmountType::where('name', 'LIKE', '%' . $daily . '%')->first(['id'])->id;
        $monthly_contract_amount_id = EmpContractAmountType::where('name', 'LIKE', '%' . $monthly . '%')->first(['id'])->id;

        $emp_pf_details = EmpPfDetail::with(['UserEmployee:id,user_id,company_id'])
            ->whereHas('UserEmployee', function ($q) use ($company_id) {
                $q->where('company_id', '=', $company_id);
            })->get(['id', 'user_id', 'pf_number', 'uan', 'bank_name', 'description', 'status', 'abry_eligible', 'is_visible', 'is_active'])->toArray();

        $pieces_emp_department_type = EmpDepartmentType::whereCompanyId($company_id)
            ->where('name', 'LIKE', '%piece rate%')
            ->get('id')->toArray();

        $i = 0;
        $batch_salary_data = array();

        /* @var $employee_contract EmpContract */
        /* @var $pf_search_data EmpPfDetail */
        foreach ($emp_contract_list as $employee_contract) {
//            if ($employee_contract->user_id == 238) {

            $monthly_basic_salary_amount = 0;
            $monthly_hra_salary_amount = 0;
            $monthly_salary_amount = 0;
            $salary_contract_hra = 0;
            $salary_contract_basic = 0;
            $salary_per_day = 0;
            $salary_hra_per_day = 0;

            $user_id = $employee_contract->user_id;
            $user_name = $employee_contract->name;
            $daily_working_hours = $employee_contract->hours - $emp_allowed_hours;

            //Contract Amount type wise Calculation
            if ($employee_contract->EmpContractType->emp_contract_amount_type_id == $daily_contract_amount_id) {
                $salary_contract_basic = round($employee_contract->salary_basic, 2) * $working_days;
                $salary_per_day = round($employee_contract->salary_basic, 2);
                $salary_hra_per_day = round($employee_contract->salary_hra, 2);

                $salary_contract_hra = $salary_hra_per_day * 26;

            } elseif ($employee_contract->EmpContractType->emp_contract_amount_type_id == $monthly_contract_amount_id) {
                $salary_contract_basic = round($employee_contract->salary_basic, 2);
                $salary_per_day = round($salary_contract_basic / ($working_days ?? 1), 2);
                $salary_hra_per_day = round($employee_contract->salary_hra / ($working_days ?? 1), 2);

                $salary_contract_hra = round($employee_contract->salary_hra, 2);
            }

            $salary_contract_total = round(($salary_contract_hra + $salary_contract_basic), 2);

            $attendances = Attendance::whereUserId($user_id)
                ->selectRaw("count(id) as total_working_days,
                    count(CASE WHEN out_time is not null and hours_worked < $daily_working_hours THEN 1 else null end)/2  as half_working_days,
                    count(CASE WHEN out_time is null or hours_worked >= $daily_working_hours THEN 1 else null end)  as full_working_days")
                ->whereMonth('date', '=', $month)
//                ->whereYear('date', '=', $year)
                ->whereNotIn('date', $monthly_off)
                ->first();

//            dd($attendances);

            $salary = Salary::whereUserId($user_id)
                ->where('month', intval($month))
                ->where('year', intval($year))
                ->first();

            if (in_array($employee_contract->emp_department_type_id, array_column($pieces_emp_department_type, 'id'))) {
                $working_days = $salary->total_days;
                $employee_working_days = $salary->present_days;
                $employee_absent_days = $salary->absent_days;
            } else {
                $full_working_days = $attendances['full_working_days'];
                $half_working_days = $attendances['half_working_days'];
                $total_working_days = $attendances['total_working_days'];

                $employee_working_days = $full_working_days + $half_working_days + count($holidays);

                $employee_absent_days = $working_days - $employee_working_days;
            }

            $monthly_basic_salary_amount = round($employee_working_days * $salary_per_day, 2);
            $monthly_hra_salary_amount = round($employee_working_days * $salary_hra_per_day, 2);
            $monthly_salary_amount = $monthly_basic_salary_amount + $monthly_hra_salary_amount;

            //PF Calculation
            $pf_search_data = array_search($user_id, array_column($emp_pf_details, 'user_id'));

            $advanceSalary = 0;
            if($salary){
                $advanceData = SalaryDetail::whereSalaryId($salary->id)
                    ->whereName('Advance')
                    ->where('type', 'D')
                    ->first(['amount']);

                if ($advanceData){
                    $advanceSalary = $advanceData->amount;
                    $salary->salary_gross_deduction = $advanceSalary;
                }
            }


            if (empty($salary)) {
                $salary = new Salary();
                $salary->created_by = Auth::id();
            }

            $salary->user_id = $user_id;
            $salary->emp_contract_id = $employee_contract->id;
            $salary->name = $user_name;
            $salary->date = $date_today;
            $salary->month = $month;
            $salary->year = $year;
            $salary->salary_contract_basic = $salary_contract_basic;
            $salary->salary_contract_hra = $salary_contract_hra;
            $salary->salary_contract_total = $salary_contract_total;
            $salary->month_days = $days_in_month;
            $salary->week_off_days = count($monthly_off);
            $salary->total_days = $working_days;
            $salary->present_days = $employee_working_days;
            $salary->absent_days = $employee_absent_days;
            $salary->salary_basic = $monthly_basic_salary_amount;
            $salary->salary_hra = $monthly_hra_salary_amount;
            $salary->salary_total = $monthly_salary_amount;
            $salary->salary_gross_earning = $monthly_salary_amount - (floatval($salary->salary_gross_deduction) ?? 0.00);
            $salary->salary_gross_deduction = (floatval($salary->salary_gross_deduction) ?? 0.00);
            $salary->overtime_type_id = 1;
            $salary->overtime_description = null;
            $salary->overtime_amount = 0;

            $pf_amount = 0;
            if ($pf_search_data !== false && $emp_pf_details[$pf_search_data]['abry_eligible'] != 1) {
                $pf_amount = round(($monthly_basic_salary_amount * $pf_percentage) / 100, 2);
                if ($pf_amount > 0) {
                    $salary->salary_gross_earning = (floatval($salary->salary_gross_earning)) - $pf_amount;
                    $salary->salary_gross_deduction = floatval($salary->salary_gross_deduction) + $pf_amount;
                }
            }
            $salary->salary_net_pay = $salary->salary_gross_earning;
            $salary->updated_by = Auth::id();
            $salary->save();

            if ($salary) {
                addSalaryDetail($salary->id, $monthly_basic_salary_amount, 'Basic', 'E', 0);
                addSalaryDetail($salary->id, $monthly_hra_salary_amount, 'HRA', 'E', 0);
                if ($salary->salary_gross_deduction > 0) {
                    if ($pf_amount > 0) {
                        $salary_pf_detail = SalaryPfDetail::whereSalaryId($salary->id)->first();
                        if (!$salary_pf_detail) {
                            $salary_pf_detail = new SalaryPfDetail();
                            $salary_pf_detail->created_by = Auth::id();
                        }
                        $salary_pf_detail->emp_pf_detail_id = $emp_pf_details[$pf_search_data]['id'];
                        $salary_pf_detail->salary_id = $salary->id;
                        $salary_pf_detail->name = $user_name;
                        $salary_pf_detail->pension_amount = $pf_amount;
                        $salary_pf_detail->updated_by = Auth::id();
                        $salary_pf_detail->save();

                        addSalaryDetail($salary->id, $pf_amount, 'PF', 'D', $pf_percentage);
                    }
                }
            }

            echo json_encode($attendances) . ' ' . $user_id . ' ' . $employee_contract['name'] . "<br>";
//                exit();
//            }
        }
//        echo json_encode($emp_list, JSON_PRETTY_PRINT);

    }

    public function salaryView(string $id): string
    {
        $salary = Salary::whereId($id)
            ->with(['UserEmployee:id,user_id,emp_code', 'UserEmployee.EmpDepartmentData:id,user_id,emp_department_type_id,description', 'UserEmployee.EmpDepartmentData.EmpDepartmentType:id,name', 'UserEmployee.EmpPfDetail:id,user_id,pf_number,uan,bank_name,description,status'])->first(['id', 'user_id', 'name', 'date', 'month', 'year', 'total_days', 'present_days', 'absent_days', 'salary_basic', 'salary_hra', 'salary_total', 'salary_gross_earning', 'salary_gross_deduction', 'salary_net_pay']);

        $data_salary_slip = new DataSalarySlip($salary);


//        $la = new AttendanceDetailView($id);
        return view('hrms.component.export.salary-slip', ['data_salary_slip' => $data_salary_slip, 'salary' => true])->render();
    }
}
