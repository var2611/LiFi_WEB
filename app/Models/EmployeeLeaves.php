<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\LeaveType|null $leaveType
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves query()
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves whereDateFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves whereDateTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves whereDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves whereFromTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves whereLeaveTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves whereManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves whereTlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves whereToTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployeeLeaves whereUserId($value)
 * @mixin \Eloquent
 */
class EmployeeLeaves extends Model
{
    public function leaveType(): HasOne
    {
        return $this->hasOne('App\Models\LeaveType', 'id', 'leave_type_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
