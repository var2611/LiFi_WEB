<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\EmpShiftData
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name
 * @property string|null $description
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $days
 * @property int|null $emp_work_shift_id
 * @property string|null $start_time
 * @property string|null $end_time
 * @property string|null $hours
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|EmpShiftData newModelQuery()
 * @method static Builder|EmpShiftData newQuery()
 * @method static Builder|EmpShiftData query()
 * @method static Builder|EmpShiftData whereCreatedAt($value)
 * @method static Builder|EmpShiftData whereCreatedBy($value)
 * @method static Builder|EmpShiftData whereDays($value)
 * @method static Builder|EmpShiftData whereDeletedAt($value)
 * @method static Builder|EmpShiftData whereDeletedBy($value)
 * @method static Builder|EmpShiftData whereDescription($value)
 * @method static Builder|EmpShiftData whereEmpWorkShiftId($value)
 * @method static Builder|EmpShiftData whereEndDate($value)
 * @method static Builder|EmpShiftData whereEndTime($value)
 * @method static Builder|EmpShiftData whereHours($value)
 * @method static Builder|EmpShiftData whereId($value)
 * @method static Builder|EmpShiftData whereIsActive($value)
 * @method static Builder|EmpShiftData whereIsVisible($value)
 * @method static Builder|EmpShiftData whereName($value)
 * @method static Builder|EmpShiftData whereStartDate($value)
 * @method static Builder|EmpShiftData whereStartTime($value)
 * @method static Builder|EmpShiftData whereUpdatedAt($value)
 * @method static Builder|EmpShiftData whereUpdatedBy($value)
 * @method static Builder|EmpShiftData whereUserId($value)
 * @mixin Eloquent
 * @property-read \App\Models\EmpWorkShift|null $EmpWorkShift
 * @property-read \App\Models\User|null $User
 */
class EmpShiftData extends Model
{
    use HasFactory;

    protected $fillable = [
        'deleted_at',
        'start_date',
        'updated_by',
        'end_date',
        'is_active',
        'name',
        'start_time',
        'is_visible',
        'user_id',
        'deleted_by',
        'hours',
        'days',
        'description',
        'emp_work_shift_id',
        'end_time',
        'created_by',
    ];

    public function EmpWorkShift(): BelongsTo
    {
        return $this->belongsTo(EmpWorkShift::class, 'emp_work_shift_id', 'id');
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
