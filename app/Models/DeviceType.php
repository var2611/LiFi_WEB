<?php


namespace App\Models;


use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\DeviceType
 *
 * @property int $id
 * @property string $name
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|DeviceType newModelQuery()
 * @method static Builder|DeviceType newQuery()
 * @method static Builder|DeviceType query()
 * @method static Builder|DeviceType whereCreatedAt($value)
 * @method static Builder|DeviceType whereCreatedBy($value)
 * @method static Builder|DeviceType whereDeletedAt($value)
 * @method static Builder|DeviceType whereDeletedBy($value)
 * @method static Builder|DeviceType whereId($value)
 * @method static Builder|DeviceType whereIsActive($value)
 * @method static Builder|DeviceType whereIsVisible($value)
 * @method static Builder|DeviceType whereName($value)
 * @method static Builder|DeviceType whereUpdatedAt($value)
 * @method static Builder|DeviceType whereUpdatedBy($value)
 * @mixin Eloquent
 */
class DeviceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
        'is_active',
        'is_visible',
    ];
}
