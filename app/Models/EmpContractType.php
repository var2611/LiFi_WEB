<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\EmpContractType
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $date
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $days
 * @property string|null $working_hours
 * @property int|null $emp_contract_status_id
 * @property int|null $emp_contract_amount_type_id
 * @property string|null $salary_total
 * @property int|null $emp_work_shift_id
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|EmpContractType newModelQuery()
 * @method static Builder|EmpContractType newQuery()
 * @method static Builder|EmpContractType query()
 * @method static Builder|EmpContractType whereAmount($value)
 * @method static Builder|EmpContractType whereCreatedAt($value)
 * @method static Builder|EmpContractType whereCreatedBy($value)
 * @method static Builder|EmpContractType whereDate($value)
 * @method static Builder|EmpContractType whereDays($value)
 * @method static Builder|EmpContractType whereDeletedAt($value)
 * @method static Builder|EmpContractType whereDeletedBy($value)
 * @method static Builder|EmpContractType whereDescription($value)
 * @method static Builder|EmpContractType whereEmpContractAmountTypeId($value)
 * @method static Builder|EmpContractType whereEmpContractStatusId($value)
 * @method static Builder|EmpContractType whereEmpWorkShiftId($value)
 * @method static Builder|EmpContractType whereEndDate($value)
 * @method static Builder|EmpContractType whereId($value)
 * @method static Builder|EmpContractType whereIsActive($value)
 * @method static Builder|EmpContractType whereIsVisible($value)
 * @method static Builder|EmpContractType whereName($value)
 * @method static Builder|EmpContractType whereStartDate($value)
 * @method static Builder|EmpContractType whereUpdatedAt($value)
 * @method static Builder|EmpContractType whereUpdatedBy($value)
 * @method static Builder|EmpContractType whereWorkingHours($value)
 * @mixin Eloquent
 * @property-read EmpContractAmountType $EmpContractAmountType
 * @property-read EmpContractStatus $EmpContractStatus
 * @property-read EmpWorkShift $EmpWorkShift
 * @property int|null $company_id
 * @method static Builder|EmpContractType whereCompanyId($value)
 * @property string|null $salary_basic
 * @property string|null $salary_hra
 * @method static Builder|EmpContractType whereSalaryBasic($value)
 * @method static Builder|EmpContractType whereSalaryHra($value)
 * @method static Builder|EmpContractType whereSalaryTotal($value)
 */
class EmpContractType extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'description',
        'date',
        'start_date',
        'end_date',
        'days',
        'working_hours',
        'emp_contract_status_id',
        'emp_contract_amount_type_id',
        'salary_basic',
        'salary_hra',
        'salary_total',
        'emp_work_shift_id',
        'is_active',
        'is_visible',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];

    public function EmpContractStatus(): BelongsTo
    {
        return $this->belongsTo(EmpContractStatus::class, 'emp_contract_status_id', 'id');
    }

    public function EmpContractAmountType(): BelongsTo
    {
        return $this->belongsTo(EmpContractAmountType::class, 'emp_contract_amount_type_id', 'id');
    }

    public function EmpWorkShift(): BelongsTo
    {
        return $this->belongsTo(EmpWorkShift::class, 'emp_work_shift_id', 'id');
    }
}
