<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\PoleLight
 *
 * @property int $id
 * @property int $pole_id
 * @property int $status
 * @property int $brightness
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|PoleLight newModelQuery()
 * @method static Builder|PoleLight newQuery()
 * @method static Builder|PoleLight query()
 * @method static Builder|PoleLight whereBrightness($value)
 * @method static Builder|PoleLight whereCreatedAt($value)
 * @method static Builder|PoleLight whereCreatedBy($value)
 * @method static Builder|PoleLight whereDeletedAt($value)
 * @method static Builder|PoleLight whereDeletedBy($value)
 * @method static Builder|PoleLight whereId($value)
 * @method static Builder|PoleLight whereIsActive($value)
 * @method static Builder|PoleLight whereIsVisible($value)
 * @method static Builder|PoleLight wherePoleId($value)
 * @method static Builder|PoleLight whereStatus($value)
 * @method static Builder|PoleLight whereUpdatedAt($value)
 * @method static Builder|PoleLight whereUpdatedBy($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Pole $Pole
 */
class PoleLight extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pole_id',
        'status',
        'brightness',
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
    public function Pole(): BelongsTo
    {
        return $this->belongsTo(Pole::class, 'id');
    }
}
