<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\SalaryPfDetail
 *
 * @property int $id
 * @property int $salary_id
 * @property string|null $name
 * @property string|null $pf_wages pf_salary
 * @property string|null $ee_amount
 * @property string|null $er_amount
 * @property string|null $pension_amount
 * @property string|null $ee_total_amount
 * @property string|null $er_total_amount
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|SalaryPfDetail newModelQuery()
 * @method static Builder|SalaryPfDetail newQuery()
 * @method static Builder|SalaryPfDetail query()
 * @method static Builder|SalaryPfDetail whereCreatedAt($value)
 * @method static Builder|SalaryPfDetail whereCreatedBy($value)
 * @method static Builder|SalaryPfDetail whereDeletedAt($value)
 * @method static Builder|SalaryPfDetail whereDeletedBy($value)
 * @method static Builder|SalaryPfDetail whereEeAmount($value)
 * @method static Builder|SalaryPfDetail whereEeTotalAmount($value)
 * @method static Builder|SalaryPfDetail whereErAmount($value)
 * @method static Builder|SalaryPfDetail whereErTotalAmount($value)
 * @method static Builder|SalaryPfDetail whereId($value)
 * @method static Builder|SalaryPfDetail whereIsActive($value)
 * @method static Builder|SalaryPfDetail whereIsVisible($value)
 * @method static Builder|SalaryPfDetail whereName($value)
 * @method static Builder|SalaryPfDetail wherePensionAmount($value)
 * @method static Builder|SalaryPfDetail wherePfWages($value)
 * @method static Builder|SalaryPfDetail whereSalaryId($value)
 * @method static Builder|SalaryPfDetail whereUpdatedAt($value)
 * @method static Builder|SalaryPfDetail whereUpdatedBy($value)
 * @mixin Eloquent
 * @property-read \App\Models\Salary $Salary
 * @property int|null $emp_pf_detail_id
 * @property-read \App\Models\EmpPfDetail $EmpPfDetail
 * @method static Builder|SalaryPfDetail whereEmpPfDetailId($value)
 */
class SalaryPfDetail extends Model
{
    protected $fillable = [
        'salary_id',
        'emp_pf_detail_id',
        'name',
        'pf_wages',
        'ee_amount',
        'er_amount',
        'pension_amount',
        'ee_total_amount',
        'er_total_amount',
        'is_active',
        'is_visible',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];

    public function Salary(): BelongsTo
    {
        return $this->belongsTo(Salary::class, 'id');
    }

    public function EmpPfDetail(): BelongsTo
    {
        return $this->belongsTo(EmpPfDetail::class, 'id');
    }


}
