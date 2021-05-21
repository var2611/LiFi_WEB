<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\LogPoleLastState
 *
 * @property int $id
 * @property int $device_id
 * @property string|null $change_value_code
 * @property string|null $change_value
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read Device $Device
 * @method static Builder|LogPoleLastState newModelQuery()
 * @method static Builder|LogPoleLastState newQuery()
 * @method static Builder|LogPoleLastState query()
 * @method static Builder|LogPoleLastState whereChangeValue($value)
 * @method static Builder|LogPoleLastState whereChangeValueCode($value)
 * @method static Builder|LogPoleLastState whereCreatedAt($value)
 * @method static Builder|LogPoleLastState whereCreatedBy($value)
 * @method static Builder|LogPoleLastState whereDeletedAt($value)
 * @method static Builder|LogPoleLastState whereDeletedBy($value)
 * @method static Builder|LogPoleLastState whereDeviceId($value)
 * @method static Builder|LogPoleLastState whereId($value)
 * @method static Builder|LogPoleLastState whereIsActive($value)
 * @method static Builder|LogPoleLastState whereIsVisible($value)
 * @method static Builder|LogPoleLastState whereUpdatedAt($value)
 * @method static Builder|LogPoleLastState whereUpdatedBy($value)
 * @mixin Eloquent
 */
class LogPoleLastState extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'device_id',
        'change_value_code',
        'change_value',
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
