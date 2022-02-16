<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\Salary
 *
 * @property int $id
 * @property int $user_id
 * @property int $emp_contract_id
 * @property string|null $name
 * @property string|null $date
 * @property string|null $total_days
 * @property string|null $present_days
 * @property string|null $absent_days
 * @property string|null $salary_amount
 * @property int $overtime_type_id
 * @property string|null $overtime_description
 * @property string|null $overtime_amount
 * @property string|null $salary_total
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
 * @method static Builder|Salary whereUserId($value)
 * @mixin Eloquent
 * @property string|null $salary_contract_basic
 * @property string|null $salary_contract_hra
 * @property string|null $salary_contract_total
 * @property string|null $salary_basic
 * @property string|null $salary_hra
 * @property string|null $salary_gross_earning
 * @property string|null $salary_gross_deduction
 * @property string|null $salary_net_pay
 * @method static Builder|Salary whereSalaryBasic($value)
 * @method static Builder|Salary whereSalaryContractBasic($value)
 * @method static Builder|Salary whereSalaryContractHra($value)
 * @method static Builder|Salary whereSalaryContractTotal($value)
 * @method static Builder|Salary whereSalaryGrossDeduction($value)
 * @method static Builder|Salary whereSalaryGrossEarning($value)
 * @method static Builder|Salary whereSalaryHra($value)
 * @method static Builder|Salary whereSalaryNetPay($value)
 * @property-read EmpContract $EmpContract
 * @property-read OvertimeType $OvertimeType
 * @property-read User $User
 * @property-read UserEmployee|null $UserEmployee
 * @property int|null $month
 * @property int|null $year
 * @method static Builder|Salary whereMonth($value)
 * @method static Builder|Salary whereYear($value)
 * @property-read Collection|SalaryDetail[] $SalaryDetail
 * @property-read int|null $salary_detail_count
 * @property-read SalaryPfDetail|null $SalaryPfDetail
 */
class Salary extends Model
{
    protected $fillable = [
        'user_id',
        'emp_contract_id',
        'name',
        'date',
        'month',
        'year',
        'total_days',
        'present_days',
        'absent_days',
        'salary_contract_basic',
        'salary_contract_hra',
        'salary_contract_total',
        'salary_basic',
        'salary_hra',
        'salary_total',
        'overtime_type_id',
        'overtime_description',
        'overtime_amount',
        'salary_gross_earning',
        'salary_gross_deduction',
        'salary_net_pay',
        'is_active',
        'is_visible',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function EmpContract(): BelongsTo
    {
        return $this->belongsTo(EmpContract::class, 'id');
    }

    public function OvertimeType(): BelongsTo
    {
        return $this->belongsTo(OvertimeType::class, 'id');
    }

    public function UserEmployee(): HasOne
    {
        return $this->hasOne(UserEmployee::class, 'user_id', 'user_id');
    }

    public function SalaryDetail(): HasMany
    {
        return $this->hasMany(SalaryDetail::class, 'salary_id', 'id');
    }

    public function SalaryPfDetail(): HasOne
    {
        return $this->hasOne(SalaryPfDetail::class, 'salary_id', 'id');
    }

}
