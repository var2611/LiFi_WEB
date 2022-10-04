<?php


namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\VehicleDriver
 *
 * @property int $id
 * @property int $vehicle_id
 * @property int $driver_id
 * @property string|null $name
 * @property string|null $start_time
 * @property string|null $end_time
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read User $Driver
 * @property-read User $Vehicle
 * @method static Builder|VehicleDriver newModelQuery()
 * @method static Builder|VehicleDriver newQuery()
 * @method static Builder|VehicleDriver query()
 * @method static Builder|VehicleDriver whereCreatedAt($value)
 * @method static Builder|VehicleDriver whereCreatedBy($value)
 * @method static Builder|VehicleDriver whereDeletedAt($value)
 * @method static Builder|VehicleDriver whereDeletedBy($value)
 * @method static Builder|VehicleDriver whereDriverId($value)
 * @method static Builder|VehicleDriver whereEndTime($value)
 * @method static Builder|VehicleDriver whereId($value)
 * @method static Builder|VehicleDriver whereIsActive($value)
 * @method static Builder|VehicleDriver whereIsVisible($value)
 * @method static Builder|VehicleDriver whereName($value)
 * @method static Builder|VehicleDriver whereStartTime($value)
 * @method static Builder|VehicleDriver whereUpdatedAt($value)
 * @method static Builder|VehicleDriver whereUpdatedBy($value)
 * @method static Builder|VehicleDriver whereVehicleId($value)
 * @mixin Eloquent
 */
class VehicleDriver extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'vehicle_id',
        'name',
        'start_time',
        'end_time',
        'is_active',
        'is_visible',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at'
    ];

    public function Vehicle(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vehicle_id');
    }

    public function Driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
