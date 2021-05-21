<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\PoleDayData
 *
 * @property int $id
 * @property int $device_id
 * @property string|null $mon_on
 * @property string|null $mon_off
 * @property string|null $tue_on
 * @property string|null $tue_off
 * @property string|null $wed_on
 * @property string|null $wed_off
 * @property string|null $thu_on
 * @property string|null $thu_off
 * @property string|null $fri_on
 * @property string|null $fri_off
 * @property string|null $sat_on
 * @property string|null $sat_off
 * @property string|null $sun_on
 * @property string|null $sun_off
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|PoleDayData newModelQuery()
 * @method static Builder|PoleDayData newQuery()
 * @method static Builder|PoleDayData query()
 * @method static Builder|PoleDayData whereCreatedAt($value)
 * @method static Builder|PoleDayData whereCreatedBy($value)
 * @method static Builder|PoleDayData whereDeletedAt($value)
 * @method static Builder|PoleDayData whereDeletedBy($value)
 * @method static Builder|PoleDayData whereDeviceId($value)
 * @method static Builder|PoleDayData whereFriOff($value)
 * @method static Builder|PoleDayData whereFriOn($value)
 * @method static Builder|PoleDayData whereId($value)
 * @method static Builder|PoleDayData whereIsActive($value)
 * @method static Builder|PoleDayData whereIsVisible($value)
 * @method static Builder|PoleDayData whereMonOff($value)
 * @method static Builder|PoleDayData whereMonOn($value)
 * @method static Builder|PoleDayData whereSatOff($value)
 * @method static Builder|PoleDayData whereSatOn($value)
 * @method static Builder|PoleDayData whereSunOff($value)
 * @method static Builder|PoleDayData whereSunOn($value)
 * @method static Builder|PoleDayData whereThuOff($value)
 * @method static Builder|PoleDayData whereThuOn($value)
 * @method static Builder|PoleDayData whereTueOff($value)
 * @method static Builder|PoleDayData whereTueOn($value)
 * @method static Builder|PoleDayData whereUpdatedAt($value)
 * @method static Builder|PoleDayData whereUpdatedBy($value)
 * @method static Builder|PoleDayData whereWedOff($value)
 * @method static Builder|PoleDayData whereWedOn($value)
 * @mixin Eloquent
 * @property-read Device $Device
 */
class PoleDayData extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'mon_on',
        'mon_off',
        'tue_on',
        'tue_off',
        'wed_on',
        'wed_off',
        'thu_on',
        'thu_off',
        'fri_on',
        'fri_off',
        'sat_on',
        'sat_off',
        'sun_on',
        'sun_off',
        'is_active',
        'is_visible',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * @return BelongsTo
     */
    public function Device(): BelongsTo
    {
        return $this->belongsTo(Device::class, 'id');
    }
}
