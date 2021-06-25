<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\LeaveDraft
 *
 * @property int $id
 * @property string $subject
 * @property string $body
 * @property int $leave_type_id
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|LeaveDraft newModelQuery()
 * @method static Builder|LeaveDraft newQuery()
 * @method static Builder|LeaveDraft query()
 * @method static Builder|LeaveDraft whereBody($value)
 * @method static Builder|LeaveDraft whereCreatedAt($value)
 * @method static Builder|LeaveDraft whereCreatedBy($value)
 * @method static Builder|LeaveDraft whereDeletedAt($value)
 * @method static Builder|LeaveDraft whereDeletedBy($value)
 * @method static Builder|LeaveDraft whereId($value)
 * @method static Builder|LeaveDraft whereIsActive($value)
 * @method static Builder|LeaveDraft whereIsVisible($value)
 * @method static Builder|LeaveDraft whereLeaveTypeId($value)
 * @method static Builder|LeaveDraft whereSubject($value)
 * @method static Builder|LeaveDraft whereUpdatedAt($value)
 * @method static Builder|LeaveDraft whereUpdatedBy($value)
 * @mixin Eloquent
 */
class LeaveDraft extends Model
{

}
