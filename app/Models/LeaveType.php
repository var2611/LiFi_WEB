<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\LeaveType
 *
 * @property int $id
 * @property string $leave_type
 * @property string|null $description
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read LeaveDraft|null $leaveDraft
 * @method static Builder|LeaveType newModelQuery()
 * @method static Builder|LeaveType newQuery()
 * @method static Builder|LeaveType query()
 * @method static Builder|LeaveType whereCreatedAt($value)
 * @method static Builder|LeaveType whereCreatedBy($value)
 * @method static Builder|LeaveType whereDeletedAt($value)
 * @method static Builder|LeaveType whereDeletedBy($value)
 * @method static Builder|LeaveType whereDescription($value)
 * @method static Builder|LeaveType whereId($value)
 * @method static Builder|LeaveType whereIsActive($value)
 * @method static Builder|LeaveType whereIsVisible($value)
 * @method static Builder|LeaveType whereLeaveType($value)
 * @method static Builder|LeaveType whereUpdatedAt($value)
 * @method static Builder|LeaveType whereUpdatedBy($value)
 * @mixin Eloquent
 * @property string $name
 * @method static Builder|LeaveType whereName($value)
 */
class LeaveType extends Model
{
    protected $fillable = array('leave_type', 'description');

    public function leaveDraft(): HasOne
    {
        return $this->hasOne('App\Models\LeaveDraft', 'id', 'leave_type_id');
    }


}
