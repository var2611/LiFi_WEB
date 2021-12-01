<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\EmpContract
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $date
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $start_time
 * @property string|null $end_time
 * @property string|null $hours
 * @property string|null $days
 * @property int $emp_contract_type_id
 * @property int $emp_contract_status_id
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
 * @property-read User $User
 * @method static Builder|EmpContract newModelQuery()
 * @method static Builder|EmpContract newQuery()
 * @method static Builder|EmpContract query()
 * @method static Builder|EmpContract whereAmount($value)
 * @method static Builder|EmpContract whereCreatedAt($value)
 * @method static Builder|EmpContract whereCreatedBy($value)
 * @method static Builder|EmpContract whereDate($value)
 * @method static Builder|EmpContract whereDays($value)
 * @method static Builder|EmpContract whereDeletedAt($value)
 * @method static Builder|EmpContract whereDeletedBy($value)
 * @method static Builder|EmpContract whereDescription($value)
 * @method static Builder|EmpContract whereEmpContractStatusId($value)
 * @method static Builder|EmpContract whereEmpContractTypeId($value)
 * @method static Builder|EmpContract whereEmpWorkShiftId($value)
 * @method static Builder|EmpContract whereEndDate($value)
 * @method static Builder|EmpContract whereEndTime($value)
 * @method static Builder|EmpContract whereHours($value)
 * @method static Builder|EmpContract whereId($value)
 * @method static Builder|EmpContract whereIsActive($value)
 * @method static Builder|EmpContract whereIsVisible($value)
 * @method static Builder|EmpContract whereName($value)
 * @method static Builder|EmpContract whereStartDate($value)
 * @method static Builder|EmpContract whereStartTime($value)
 * @method static Builder|EmpContract whereUpdatedAt($value)
 * @method static Builder|EmpContract whereUpdatedBy($value)
 * @method static Builder|EmpContract whereUserId($value)
 * @mixin Eloquent
 * @property int|null $emp_shift_data_id
 * @property-read EmpContractStatus $EmpContractStatus
 * @property-read EmpContractType $EmpContractType
 * @method static Builder|EmpContract whereEmpShiftDataId($value)
 * @property-read EmpShiftData $EmpShiftData
 * @property string|null $salary_basic
 * @property string|null $salary_hra
 * @method static Builder|EmpContract whereSalaryBasic($value)
 * @method static Builder|EmpContract whereSalaryHra($value)
 * @method static Builder|EmpContract whereSalaryTotal($value)
 * @property-read \App\Models\EmpPfDetail|null $EmpPfDetail
 */
class EmpContract extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'date',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'hours',
        'days',
        'emp_contract_type_id',
        'emp_contract_status_id',
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

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function EmpContractType(): BelongsTo
    {
        return $this->belongsTo(EmpContractType::class, 'id');
    }

    public function EmpContractStatus(): BelongsTo
    {
        return $this->belongsTo(EmpContractStatus::class, 'id');
    }

    public function EmpShiftData(): BelongsTo
    {
        return $this->belongsTo(EmpShiftData::class, 'id');
    }

    public function EmpPfDetail(): HasOne
    {
        return $this->hasOne(EmpPfDetail::class, 'user_id', 'user_id');
    }


}
