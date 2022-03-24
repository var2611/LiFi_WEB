<?php

namespace App\Models\FormModels;

use App\Models\Salary;
use App\Models\SalaryDetail;

/**
 * @property Salary $salary_data
 * @property int $salary_id
 * @property string|null $emp_code
 * @property string|null $name
 * @property string|null $salary_contract_basic
 * @property string|null $salary_contract_hra
 * @property string|null $salary_contract_total
 * @property string|null $salary_basic
 * @property string|null $salary_hra
 * @property string|null $salary_pf
 * @property string|null $salary_advance
 * @property string|null $salary_total
 * @property string|null $salary_gross_earning
 * @property string|null $salary_gross_deduction
 * @property string|null $salary_net_pay
 * @property string|null $total_days
 * @property string|null $present_days
 * @property string|null $absent_days
 */
class DataSalaryEdit extends \Illuminate\Database\Eloquent\Model
{
    private $salary_data;

    public function setSalaryData($salary_data)
    {
        $this->salary_data = $salary_data;

        $this->salary_id = $this->salary_data->id;
        $this->emp_code = $this->salary_data->UserEmployee->emp_code;
        $this->name = $this->salary_data->name;
        $this->salary_contract_basic = $this->salary_data->salary_contract_basic;
        $this->salary_contract_hra = $this->salary_data->salary_contract_hra;
        $this->salary_contract_total = $this->salary_data->salary_contract_total;
        $this->salary_basic = $this->getSalaryDetailsData('E', 'Basic');
        $this->salary_hra = $this->getSalaryDetailsData('E', 'HRA');
        $this->salary_pf = $this->getSalaryDetailsData('D', 'PF');
        $this->salary_advance = $this->getSalaryDetailsData('D', 'Advance');
        $this->salary_total = $this->salary_data->salary_total;
        $this->salary_gross_earning = $this->salary_data->salary_gross_earning;
        $this->salary_gross_deduction = $this->salary_data->salary_gross_deduction;
        $this->salary_net_pay = $this->salary_data->salary_net_pay;
        $this->total_days = $this->salary_data->total_days;
        $this->present_days = $this->salary_data->present_days;
        $this->absent_days = $this->salary_data->absent_days;
    }

    private function getSalaryDetailsData(string $type, string $name){
        return SalaryDetail::whereSalaryId($this->salary_id)
                ->where('type', $type)
                ->where('name', $name)
                ->first()->amount ?? '0';
    }

    public function setFormData($formData)
    {
        $this->salary_id = $formData['salary_id'] ?? 0;
        $this->emp_code = $formData['emp_code'] ?? 0;
        $this->name = $formData['name'] ?? 0;
        $this->salary_contract_basic = $formData['salary_contract_basic'] ?? 0;
        $this->salary_contract_hra = $formData['salary_contract_hra'] ?? 0;
        $this->salary_contract_total = $formData['salary_contract_total'] ?? 0;
        $this->salary_basic = $formData['salary_basic'] ?? 0;
        $this->salary_hra = $formData['salary_hra'] ?? 0;
        $this->salary_pf = $formData['salary_pf'] ?? 0;
        $this->salary_advance = $formData['salary_advance'] ?? 0;
        $this->salary_total = $formData['salary_total'] ?? 0;
        $this->salary_gross_earning = $formData['salary_gross_earning'] ?? 0;
        $this->salary_gross_deduction = $formData['salary_gross_deduction'] ?? 0;
        $this->salary_net_pay = $formData['salary_net_pay'] ?? 0;
        $this->total_days = $formData['total_days'] ?? 0;
        $this->present_days = $formData['present_days'] ?? 0;
        $this->absent_days = $formData['absent_days'] ?? 0;
    }

    public function saveSalary(){
        $salary = Salary::whereId($this->salary_id)->first();

        $salary->salary_basic = $this->salary_basic;
        $salary->salary_hra = $this->salary_hra;
        $salary->salary_total = $this->salary_total;
        $salary->salary_gross_earning = $this->salary_gross_earning;
        $salary->salary_gross_deduction = $this->salary_gross_deduction;
        $salary->salary_net_pay = $this->salary_net_pay;
        $salary->present_days = $this->present_days;
        $salary->absent_days = $this->absent_days;
        $salary->save();

        addSalaryDetail($salary->id, $this->salary_basic, 'Basic', 'E', 0);
        addSalaryDetail($salary->id, $this->salary_hra, 'HRA', 'E', 0);
        addSalaryDetail($salary->id, $this->salary_pf, 'PF', 'D', 0);
        addSalaryDetail($salary->id, $this->salary_advance, 'Advance', 'D', 0);
    }
}
