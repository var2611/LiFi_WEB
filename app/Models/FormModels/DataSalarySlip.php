<?php

namespace App\Models\FormModels;

use App\Models\Salary;
use App\Models\SalaryDetail;

/**
 * @property string|null $emp_code
 * @property string|null $name
 * @property Salary $salary_data
 * @property string|null $salary_basic
 * @property string|null $salary_hra
 * @property string|null $salary_total
 * @property string|null $salary_gross_earning
 * @property string|null $salary_gross_deduction
 * @property int $salary_id
 * @property string|null $salary_net_pay
 * @property string|null $departmentType
 * @property string|null $description
 */
class DataSalarySlip
{
    private $salary_data;

    /**
     *
     */
    public function __construct($salary_data)
    {
        $this->salary_data = $salary_data;
        $this->setUserData();
        $this->serEarningData();
    }

    private function setUserData()
    {
        $this->salary_id = $this->salary_data->id;
        $this->emp_code = $this->salary_data->UserEmployee->emp_code;
        $this->name = ($this->salary_data->UserEmployee->User->name) . ' ' . ($this->salary_data->UserEmployee->User->name ?? '');
        $this->departmentType = $this->salary_data->UserEmployee->EmpDepartmentData->EmpDepartmentType->name;
        $this->description = $this->salary_data->UserEmployee->EmpDepartmentData->description;


    }

    private function serEarningData()
    {
        $this->salary_total = $this->salary_data->salary_total;
        $this->salary_gross_earning = $this->salary_data->salary_gross_earning;
        $this->salary_gross_deduction = $this->salary_data->salary_gross_deduction;
        $this->salary_net_pay = $this->salary_data->salary_net_pay;
    }

    public function getEarningData()
    {
        return SalaryDetail::whereSalaryId($this->salary_id)
            ->where('type', 'E')->get();
    }

    public function getDeductionData(): array
    {
        return SalaryDetail::whereSalaryId($this->salary_id)
            ->where('type', 'D')->get();
    }


}
