<?php

namespace App\Http\Controllers\web;

use App\Forms\Salary\ImportSalary;
use App\Forms\Salary\OverTimeTypeForm;
use App\Forms\Salary\SalaryAllowanceTypeForm;
use App\Forms\Salary\SalaryForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\ListOverTimeType;
use App\Http\Livewire\ListSalary;
use App\Http\Livewire\ListSalaryAllowanceType;
use App\Models\Attendance;
use App\Models\EmpContract;
use App\Models\EmpPfDetail;
use App\Models\FormModels\DataSalarySlip;
use App\Models\ImportPublicWifiSeasonData;
use App\Models\OvertimeType;
use App\Models\Salary;
use App\Models\SalaryAllowanceType;
use App\Models\SalaryDetail;
use App\Models\SalaryPfDetail;
use Auth;
use Illuminate\Support\Facades\Request;
use LaravelViews\LaravelViews;
use Maatwebsite\Excel\Validators\ValidationException;
use Nette\Utils\DateTime;

class SalaryController extends Controller
{
    public function overTimeTypeCreate(string $id = null)
    {
        $model = new OvertimeType();
        return $this->createForm($id, OverTimeTypeForm::class, $model, route('overtime-type-store'), 'salary');
    }

    public function overTimeTypeStore(): string
    {
        $model = new OvertimeType();
        return $this->formStore(OverTimeTypeForm::class, $model, 'list-overtime-type', 'salary', 'Over Time Type');
    }

    public function salaryAllowanceTypeCreate(string $id = null)
    {
        $model = new SalaryAllowanceType();
        return $this->createForm($id, SalaryAllowanceTypeForm::class, $model, route('salary-allowance-type-store'), 'salary');
    }

    public function salaryAllowanceTypeStore(): string
    {
        $model = new SalaryAllowanceType();
        return $this->formStore(SalaryAllowanceTypeForm::class, $model, 'list-salary-allowance-type', 'salary', 'Salary Allowance Type');
    }

    public function salaryAllowanceTypeList(LaravelViews $laravelViews, Request $request): string
    {
        return $this->createList($laravelViews, ListSalaryAllowanceType::class, 'Salary Allowance Type List', 'salary', route('salary-allowance-type-edit'));
    }

    public function salaryList(LaravelViews $laravelViews, Request $request): string
    {
        return $this->createList($laravelViews, ListSalary::class, 'Salary List', 'salary');
    }

    public function overtimeTypeList(LaravelViews $laravelViews, Request $request): string
    {
        return $this->createList($laravelViews, ListOverTimeType::class, 'Overtime Type List', 'salary', route('overtime-type-edit'));
    }

    public function salaryCreate(string $id = null)
    {
        $model = new Salary();
        return $this->createForm($id, SalaryForm::class, $model, route('overtime-type-store'), 'salary');
    }

    public function importSalaryCreate()
    {
        $model = new ImportPublicWifiSeasonData();
        $form = $this->createFormData(null, ImportSalary::class, $model, route('import-salary-store'), 'salary');

        return $this->createFormView($form);
    }

    public function importSalaryStore()
    {
        $model = new ImportPublicWifiSeasonData();
//        $form = $this->formStoreData(ImportSalary::class);
        $form = $this->form(ImportSalary::class);
        $form->redirectIfNotValid();

//        print_r($form->getFieldValues());
        if ($form->getRequest()->hasFile('salary_sheet')) {

            try {
                $file = $form->getRequest()->file('salary_sheet');
//                $import = Excel::import(new ImportPaarthAttendanceCreateUser(10, 2021, 4), $file);
//                $import = Excel::import(new ImportPaarthAttendanceAdd(10, 2021), $file);
//                $import = Excel::import(new ImportParthSalarySheet(3, 4), $file);

//                (new ImportParthSalarySheet)->toCollection($file);

//                $heading = (new HeadingRowImport(2))->toArray($file);


//                echo json_encode($heading, JSON_PRETTY_PRINT);
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
        $month = 10;
        $year = 2021;
        $company_id = 4;
        $holidays = ['2021-10-02', '2021-10-15'];
        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $sundays = getSundays($month, $year, $days_in_month);
        $monthly_off = array_unique(array_merge($holidays, $sundays));
        $working_days = $days_in_month - count($sundays);
        $pf_percentage = 12;

        $emp_contract_list = EmpContract::join('user_employees', 'emp_contracts.user_id', '=', 'user_employees.user_id')
//            ->with(['User:id,name,last_name', 'EmpPfDetail'])
            ->where('user_employees.company_id', $company_id)
            ->get(['emp_contracts.id', 'emp_contracts.user_id', 'emp_contracts.name', 'emp_contracts.hours', 'emp_contracts.salary_basic', 'emp_contracts.salary_hra', 'emp_contracts.salary_total']);

//        echo json_encode(($emp_contract_list)) . '<br>';
//        exit();

        $emp_pf_details = EmpPfDetail::join('user_employees', 'emp_pf_details.user_id', '=', 'user_employees.user_id')
            ->where('user_employees.company_id', $company_id)->get(['emp_pf_details.id', 'emp_pf_details.user_id', 'emp_pf_details.pf_number', 'emp_pf_details.uan', 'emp_pf_details.bank_name', 'emp_pf_details.description', 'emp_pf_details.status', 'emp_pf_details.is_visible', 'emp_pf_details.is_active'])->toArray();

        $i = 0;
        $batch_salary_data = array();

        /* @var $employee_contract EmpContract */
        foreach ($emp_contract_list as $employee_contract) {
//            if ($employee_contract->user_id == 224) {
            $user_id = $employee_contract->user_id;
            $user_name = $employee_contract->name;
            $daily_working_hours = $employee_contract->hours - 3;
            $salary_contract_basic = round($employee_contract->salary_basic, 2);
            $salary_contract_hra = round($employee_contract->salary_hra, 2);
            $salary_contract_total = round($employee_contract->salary_total, 2);
            $salary_per_day = round($salary_contract_basic / ($working_days ?? 1), 2);
            $salary_hra_per_day = round($salary_contract_hra / ($working_days ?? 1), 2);

            $attendances = Attendance::whereUserId($user_id)
                ->selectRaw("count(id) as total_working_days,
                    count(CASE WHEN hours_worked < $daily_working_hours THEN 1 else null end)/2  as half_working_days, count(CASE WHEN hours_worked >= $daily_working_hours THEN 1 else null end)  as full_working_days")
                ->whereMonth('date', '=', $month)
                ->whereNotIn('date', $monthly_off)
                ->first();

            $full_working_days = $attendances['full_working_days'];
            $half_working_days = $attendances['half_working_days'];
            $total_working_days = $attendances['total_working_days'];

            $employee_working_days = $full_working_days + $half_working_days + count($holidays);

            $employee_absent_days = $working_days - $employee_working_days;

            $monthly_basic_salary_amount = round($employee_working_days * $salary_per_day, 2);
            $monthly_hra_salary_amount = round($employee_working_days * $salary_hra_per_day, 2);
            $monthly_salary_amount = $monthly_basic_salary_amount + $monthly_hra_salary_amount;

            //PF Calculation
            $pf_amount = 0;
            $search_data = array_search($user_id, array_column($emp_pf_details, 'user_id'));

            $salary = Salary::whereUserId($user_id)
                ->where('month', $month)
                ->where('year', $year)
                ->first();

            if (empty($salary)) {
                $salary = new Salary();
                $salary->created_by = Auth::id();
            }

            $salary->user_id = $user_id;
            $salary->emp_contract_id = $employee_contract->id;
            $salary->name = $user_name;
            $salary->date = getTodayDate();
            $salary->month = $month;
            $salary->year = $year;
            $salary->salary_contract_basic = $salary_contract_basic;
            $salary->salary_contract_hra = $salary_contract_hra;
            $salary->salary_contract_total = $salary_contract_total;
            $salary->total_days = $working_days;
            $salary->present_days = $employee_working_days;
            $salary->absent_days = $employee_absent_days;
            $salary->salary_basic = $monthly_basic_salary_amount;
            $salary->salary_hra = $monthly_hra_salary_amount;
            $salary->salary_total = $monthly_salary_amount;
            $salary->salary_gross_earning = $monthly_salary_amount;
            $salary->salary_gross_deduction = 0.00;
            $salary->overtime_type_id = 1;
            $salary->overtime_description = null;
            $salary->overtime_amount = 0;

            $pf_amount = 0;
            if ($emp_pf_details[$search_data]) {
                $pf_amount = round(($monthly_basic_salary_amount * $pf_percentage) / 100, 2);
                if ($pf_amount > 0) {
                    $salary->salary_gross_earning = $salary->salary_gross_earning - $pf_amount;
                    $salary->salary_gross_deduction = $salary->salary_gross_deduction + $pf_amount;
                }
            }
            $salary->salary_net_pay = $salary->salary_gross_earning;
            $salary->updated_by = Auth::id();
            $salary->save();

            if ($salary) {
                $this->addSalaryDetail($salary->id, $monthly_basic_salary_amount, 'Basic', 'E', 0);
                $this->addSalaryDetail($salary->id, $monthly_hra_salary_amount, 'HRA', 'E', 0);
                if ($salary->salary_gross_deduction > 0) {
                    if ($pf_amount > 0) {
                        $salary_pf_detail = SalaryPfDetail::whereSalaryId($salary->id)->first();
                        if (!$salary_pf_detail) {
                            $salary_pf_detail = new SalaryPfDetail();
                            $salary_pf_detail->created_by = Auth::id();
                        }
                        $salary_pf_detail->salary_id = $salary->id;
                        $salary_pf_detail->name = $user_name;
                        $salary_pf_detail->pension_amount = $pf_amount;
                        $salary_pf_detail->updated_by = Auth::id();
                        $salary_pf_detail->save();

                        $this->addSalaryDetail($salary->id, $pf_amount, 'PF', 'D', $pf_percentage);
                    }
                }
            }

            echo json_encode($attendances) . ' ' . $user_id . ' ' . $employee_contract['name'] . "<br>";
//                exit();
//            }
        }
//        echo json_encode($emp_list, JSON_PRETTY_PRINT);

    }

    private function addSalaryDetail(int $salary_id, string $amount, string $amount_type_name, string $amount_type, string $percentage)
    {
        $salary_detail = SalaryDetail::whereSalaryId($salary_id)
            ->whereName($amount_type_name)
            ->where('type', $amount_type)->first();

        if (!$salary_detail) {
            $salary_detail = new SalaryDetail();
            $salary_detail->created_by = Auth::id();
        }
        $salary_detail->salary_id = $salary_id;
        $salary_detail->name = $amount_type_name;
        $salary_detail->type = $amount_type;
        $salary_detail->amount = $amount;
        $salary_detail->percentage = $percentage;
        $salary_detail->updated_by = Auth::id();
        $salary_detail->save();
    }

    public function salaryView(string $id): string
    {
        $salary = Salary::whereId($id)
            ->with(['UserEmployee:id,user_id,emp_code', 'UserEmployee.EmpDepartmentData:id,user_id,emp_department_type_id,description', 'UserEmployee.EmpDepartmentData.EmpDepartmentType:id,name', 'UserEmployee.EmpPfDetail:id,user_id,pf_number,uan,bank_name,description,status'])->first(['id', 'user_id', 'name', 'date', 'month', 'year', 'salary_basic', 'salary_hra', 'salary_total', 'salary_gross_earning', 'salary_gross_deduction', 'salary_net_pay']);

//        echo json_encode($salary->month) . "<br>";
//        echo json_encode(DateTime::createFromFormat('!m', "$salary->month")->format('F')) . '<br>';
//        exit();

        $data_salary_slip = new DataSalarySlip($salary);


//        $la = new AttendanceDetailView($id);
        return view('layouts.salary-slip', ['data_salary_slip' => $data_salary_slip, 'salary' => true])->render();
    }
}
