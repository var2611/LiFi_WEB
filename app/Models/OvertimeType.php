<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\OvertimeType
 *
 * @property int $id
 * @property string|null $name
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|OvertimeType newModelQuery()
 * @method static Builder|OvertimeType newQuery()
 * @method static Builder|OvertimeType query()
 * @method static Builder|OvertimeType whereCreatedAt($value)
 * @method static Builder|OvertimeType whereCreatedBy($value)
 * @method static Builder|OvertimeType whereDeletedAt($value)
 * @method static Builder|OvertimeType whereDeletedBy($value)
 * @method static Builder|OvertimeType whereId($value)
 * @method static Builder|OvertimeType whereIsActive($value)
 * @method static Builder|OvertimeType whereIsVisible($value)
 * @method static Builder|OvertimeType whereName($value)
 * @method static Builder|OvertimeType whereUpdatedAt($value)
 * @method static Builder|OvertimeType whereUpdatedBy($value)
 * @mixin Eloquent
 */
class OvertimeType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_active',
        'is_visible',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];
}
