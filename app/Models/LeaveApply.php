<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\LeaveApply
 *
 * @property int $id
 * @property string $dateFrom
 * @property string $dateTo
 * @property string|null $reason
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read LeaveTypeApply|null $leavetypeapply
 * @method static Builder|LeaveApply newModelQuery()
 * @method static Builder|LeaveApply newQuery()
 * @method static Builder|LeaveApply query()
 * @method static Builder|LeaveApply whereCreatedAt($value)
 * @method static Builder|LeaveApply whereCreatedBy($value)
 * @method static Builder|LeaveApply whereDateFrom($value)
 * @method static Builder|LeaveApply whereDateTo($value)
 * @method static Builder|LeaveApply whereDeletedAt($value)
 * @method static Builder|LeaveApply whereDeletedBy($value)
 * @method static Builder|LeaveApply whereId($value)
 * @method static Builder|LeaveApply whereIsActive($value)
 * @method static Builder|LeaveApply whereIsVisible($value)
 * @method static Builder|LeaveApply whereReason($value)
 * @method static Builder|LeaveApply whereUpdatedAt($value)
 * @method static Builder|LeaveApply whereUpdatedBy($value)
 * @mixin Eloquent
 */
class LeaveApply extends Model
{
    public function leavetypeapply()
    {
        return $this->hasOne('App\Models\LeaveTypeApply', 'leave_apply_id', 'id');
    }
}
