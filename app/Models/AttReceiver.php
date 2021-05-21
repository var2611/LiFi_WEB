<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\AttReceiver
 *
 * @property int $id
 * @property int $device_id
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read Device $Device
 * @method static Builder|AttReceiver newModelQuery()
 * @method static Builder|AttReceiver newQuery()
 * @method static Builder|AttReceiver query()
 * @method static Builder|AttReceiver whereCreatedAt($value)
 * @method static Builder|AttReceiver whereCreatedBy($value)
 * @method static Builder|AttReceiver whereDeletedAt($value)
 * @method static Builder|AttReceiver whereDeletedBy($value)
 * @method static Builder|AttReceiver whereDeviceId($value)
 * @method static Builder|AttReceiver whereId($value)
 * @method static Builder|AttReceiver whereIsActive($value)
 * @method static Builder|AttReceiver whereIsVisible($value)
 * @method static Builder|AttReceiver whereUpdatedAt($value)
 * @method static Builder|AttReceiver whereUpdatedBy($value)
 * @mixin Eloquent
 */
class AttReceiver extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'device_id',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
        'is_active',
        'is_visible',
    ];

    /**
     * @return BelongsTo
     */
    public function Device(): BelongsTo
    {
        return $this->belongsTo(Device::class, 'id');
    }
}
