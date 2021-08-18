<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\EmployeeLeaves
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $tl_id
 * @property int|null $manager_id
 * @property int $leave_type_id
 * @property string $date_from
 * @property string $date_to
 * @property string $from_time
 * @property string $to_time
 * @property string|null $days
 * @property int $status 0 = Unapproved, 1 = Approved
 * @property string|null $remarks
 * @property string $reason
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read LeaveType|null $leaveType
 * @property-read User $user
 * @method static Builder|EmployeeLeave newModelQuery()
 * @method static Builder|EmployeeLeave newQuery()
 * @method static Builder|EmployeeLeave query()
 * @method static Builder|EmployeeLeave whereCreatedAt($value)
 * @method static Builder|EmployeeLeave whereCreatedBy($value)
 * @method static Builder|EmployeeLeave whereDateFrom($value)
 * @method static Builder|EmployeeLeave whereDateTo($value)
 * @method static Builder|EmployeeLeave whereDays($value)
 * @method static Builder|EmployeeLeave whereDeletedAt($value)
 * @method static Builder|EmployeeLeave whereDeletedBy($value)
 * @method static Builder|EmployeeLeave whereFromTime($value)
 * @method static Builder|EmployeeLeave whereId($value)
 * @method static Builder|EmployeeLeave whereIsActive($value)
 * @method static Builder|EmployeeLeave whereIsVisible($value)
 * @method static Builder|EmployeeLeave whereLeaveTypeId($value)
 * @method static Builder|EmployeeLeave whereManagerId($value)
 * @method static Builder|EmployeeLeave whereReason($value)
 * @method static Builder|EmployeeLeave whereRemarks($value)
 * @method static Builder|EmployeeLeave whereStatus($value)
 * @method static Builder|EmployeeLeave whereTlId($value)
 * @method static Builder|EmployeeLeave whereToTime($value)
 * @method static Builder|EmployeeLeave whereUpdatedAt($value)
 * @method static Builder|EmployeeLeave whereUpdatedBy($value)
 * @method static Builder|EmployeeLeave whereUserId($value)
 * @mixin Eloquent
 * @property-read \App\Models\UserEmployee $userEmployee
 */
class EmployeeLeave extends Model
{
    public function leaveType(): HasOne
    {
        return $this->hasOne('App\Models\LeaveType', 'id', 'leave_type_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function userEmployee(): BelongsTo
    {
        return $this->belongsTo(UserEmployee::class, 'user_id', 'user_id');
    }
}
