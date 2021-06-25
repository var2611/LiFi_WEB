<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\LeaveUpload
 *
 * @property int $id
 * @property string $name
 * @property string|null $seller_name
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|LeaveUpload newModelQuery()
 * @method static Builder|LeaveUpload newQuery()
 * @method static Builder|LeaveUpload query()
 * @method static Builder|LeaveUpload whereCreatedAt($value)
 * @method static Builder|LeaveUpload whereCreatedBy($value)
 * @method static Builder|LeaveUpload whereDeletedAt($value)
 * @method static Builder|LeaveUpload whereDeletedBy($value)
 * @method static Builder|LeaveUpload whereId($value)
 * @method static Builder|LeaveUpload whereIsActive($value)
 * @method static Builder|LeaveUpload whereIsVisible($value)
 * @method static Builder|LeaveUpload whereName($value)
 * @method static Builder|LeaveUpload whereSellerName($value)
 * @method static Builder|LeaveUpload whereUpdatedAt($value)
 * @method static Builder|LeaveUpload whereUpdatedBy($value)
 * @mixin Eloquent
 */
class LeaveUpload extends Model
{
    //
}
