<?php

namespace App\Models\FormModels;

use App\Models\Salary;
use App\Models\SalaryDetail;
use Nette\Utils\DateTime;

/**
 * @property string|null $emp_code
 * @property string|null $name
 * @property Salary $salary_data
 * @property string|null $salary_contract_basic
 * @property string|null $salary_contract_hra
 * @property string|null $salary_contract_total
 * @property string|null $salary_basic
 * @property string|null $salary_hra
 * @property string|null $salary_total
 * @property string|null $pf_number
 * @property string|null $salary_gross_earning
 * @property string|null $salary_gross_deduction
 * @property int $salary_id
 * @property string|null $salary_net_pay
 * @property string|null $departmentType
 * @property string|null $description
 * @property string $uan
 * @property int|null $salary_year
 * @property string $salary_month
 * @property string $salary_to_number
 * @property false|string $salary_net_pay_in_words
 * @property string|null $month_days
 * @property string|null $week_off_days
 * @property string|null $total_days
 * @property string|null $present_days
 * @property string|null $absent_days
 * @property string|null $pf_amount
 * @property string|null $advance_amount
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
        $this->setEarningData();
    }

    private function setUserData()
    {
        $this->salary_id = $this->salary_data->id;
        $this->emp_code = $this->salary_data->UserEmployee->emp_code;
        $this->name = ($this->salary_data->UserEmployee->User->name) . ' ' . ($this->salary_data->UserEmployee->User->name ?? '');
        $this->departmentType = $this->salary_data->UserEmployee->EmpDepartmentData->EmpDepartmentType->name;
        $this->description = $this->salary_data->UserEmployee->EmpDepartmentData->description;
        $this->pf_number = $this->salary_data->SalaryPfDetail->EmpPfDetail->pf_number ?? ucfirst('nil');
        $this->uan = $this->salary_data->SalaryPfDetail->EmpPfDetail->uan ?? ucfirst('nil');
        $this->salary_month = getMonthNameFromMonthNumber($this->salary_data->month);
        $this->salary_year = $this->salary_data->year;
        $this->month_days = $this->salary_data->month_days;
        $this->week_off_days = $this->salary_data->week_off_days;
        $this->total_days = $this->salary_data->total_days;
        $this->present_days = $this->salary_data->present_days;
        $this->absent_days = $this->salary_data->absent_days;
    }

    private function setEarningData()
    {
        $this->salary_contract_basic = getFormattedAmountCurrency($this->salary_data->salary_contract_basic);
        $this->salary_contract_hra = getFormattedAmountCurrency($this->salary_data->salary_contract_hra);
        $this->salary_contract_total = getFormattedAmountCurrency($this->salary_data->salary_contract_total);
        $this->salary_basic = getFormattedAmountCurrency($this->salary_data->salary_basic);
        $this->salary_hra = getFormattedAmountCurrency($this->salary_data->salary_hra);
        $this->salary_total = getFormattedAmountCurrency($this->salary_data->salary_total);
        $this->salary_gross_earning = getFormattedAmountCurrency($this->salary_data->salary_gross_earning);
        $this->salary_gross_deduction = getFormattedAmountCurrency($this->salary_data->salary_gross_deduction);
        $this->salary_net_pay = getFormattedAmountCurrency($this->salary_data->salary_net_pay);
        $this->salary_net_pay_in_words = getNumberToWord($this->salary_data->salary_net_pay);

        //Deduction Data
        $this->pf_amount = getFormattedAmountCurrency(getSalaryDetailsData($this->salary_data->id, 'D', 'PF'));
        $this->advance_amount = getFormattedAmountCurrency(getSalaryDetailsData($this->salary_data->id, 'D', 'Advance'));

    }

    public function getEarningData()
    {
        return SalaryDetail::whereSalaryId($this->salary_id)
            ->where('type', 'E')->get();
    }

    public function getDeductionData()
    {
        return SalaryDetail::whereSalaryId($this->salary_id)
            ->where('type', 'D')->get();
    }


}
