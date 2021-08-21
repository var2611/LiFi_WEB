<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Salary
 *
 * @property int $id
 * @property int $user_employee_id
 * @property int $emp_contract_id
 * @property string|null $name
 * @property string|null $date
 * @property string|null $contract_amount
 * @property string|null $total_days
 * @property string|null $present_days
 * @property string|null $absent_days
 * @property string|null $basic
 * @property string|null $hra
 * @property string|null $salary_amount
 * @property int $overtime_type_id
 * @property string|null $overtime_description
 * @property string|null $overtime_amount
 * @property string|null $salary_total
 * @property string|null $gross_earning
 * @property string|null $gross_deduction
 * @property string|null $net_pay
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|Salary newModelQuery()
 * @method static Builder|Salary newQuery()
 * @method static Builder|Salary query()
 * @method static Builder|Salary whereAbsentDays($value)
 * @method static Builder|Salary whereBasic($value)
 * @method static Builder|Salary whereContractAmount($value)
 * @method static Builder|Salary whereCreatedAt($value)
 * @method static Builder|Salary whereCreatedBy($value)
 * @method static Builder|Salary whereDate($value)
 * @method static Builder|Salary whereDeletedAt($value)
 * @method static Builder|Salary whereDeletedBy($value)
 * @method static Builder|Salary whereEmpContractId($value)
 * @method static Builder|Salary whereGrossDeduction($value)
 * @method static Builder|Salary whereGrossEarning($value)
 * @method static Builder|Salary whereHra($value)
 * @method static Builder|Salary whereId($value)
 * @method static Builder|Salary whereIsActive($value)
 * @method static Builder|Salary whereIsVisible($value)
 * @method static Builder|Salary whereName($value)
 * @method static Builder|Salary whereNetPay($value)
 * @method static Builder|Salary whereOvertimeAmount($value)
 * @method static Builder|Salary whereOvertimeDescription($value)
 * @method static Builder|Salary whereOvertimeTypeId($value)
 * @method static Builder|Salary wherePresentDays($value)
 * @method static Builder|Salary whereSalaryAmount($value)
 * @method static Builder|Salary whereSalaryTotal($value)
 * @method static Builder|Salary whereTotalDays($value)
 * @method static Builder|Salary whereUpdatedAt($value)
 * @method static Builder|Salary whereUpdatedBy($value)
 * @method static Builder|Salary whereUserEmployeeId($value)
 * @mixin Eloquent
 */
class Salary extends Model
{

}
