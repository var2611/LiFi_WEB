<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\LeaveTypeApply
 *
 * @property int $id
 * @property int $leave_type_id
 * @property int $leave_apply_id
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read LeaveType|null $leaveType
 * @method static Builder|LeaveTypeApply newModelQuery()
 * @method static Builder|LeaveTypeApply newQuery()
 * @method static Builder|LeaveTypeApply query()
 * @method static Builder|LeaveTypeApply whereCreatedAt($value)
 * @method static Builder|LeaveTypeApply whereCreatedBy($value)
 * @method static Builder|LeaveTypeApply whereDeletedAt($value)
 * @method static Builder|LeaveTypeApply whereDeletedBy($value)
 * @method static Builder|LeaveTypeApply whereId($value)
 * @method static Builder|LeaveTypeApply whereIsActive($value)
 * @method static Builder|LeaveTypeApply whereIsVisible($value)
 * @method static Builder|LeaveTypeApply whereLeaveApplyId($value)
 * @method static Builder|LeaveTypeApply whereLeaveTypeId($value)
 * @method static Builder|LeaveTypeApply whereUpdatedAt($value)
 * @method static Builder|LeaveTypeApply whereUpdatedBy($value)
 * @mixin Eloquent
 */
class LeaveTypeApply extends Model
{
    protected $fillable = array('leave_type_id');

    public function leaveType(): HasOne
    {
        return $this->hasOne('App\Models\LeaveType', 'id', 'leave_type_id');
    }

}
