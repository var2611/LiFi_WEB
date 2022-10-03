<?php


namespace App\Models;


use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\VehicleUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $vehicle_id
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
 * @method static Builder|VehicleUser newModelQuery()
 * @method static Builder|VehicleUser newQuery()
 * @method static Builder|VehicleUser query()
 * @method static Builder|VehicleUser whereCreatedAt($value)
 * @method static Builder|VehicleUser whereCreatedBy($value)
 * @method static Builder|VehicleUser whereDeletedAt($value)
 * @method static Builder|VehicleUser whereDeletedBy($value)
 * @method static Builder|VehicleUser whereEndTime($value)
 * @method static Builder|VehicleUser whereId($value)
 * @method static Builder|VehicleUser whereIsActive($value)
 * @method static Builder|VehicleUser whereIsVisible($value)
 * @method static Builder|VehicleUser whereName($value)
 * @method static Builder|VehicleUser whereStartTime($value)
 * @method static Builder|VehicleUser whereUpdatedAt($value)
 * @method static Builder|VehicleUser whereUpdatedBy($value)
 * @method static Builder|VehicleUser whereUserId($value)
 * @method static Builder|VehicleUser whereVehicleId($value)
 * @mixin Eloquent
 */
class VehicleUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
