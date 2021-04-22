<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\LogPoleLastState
 *
 * @property int $id
 * @property int $pole_id
 * @property string|null $change_value_code
 * @property string|null $change_value
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Pole $Pole
 * @method static \Illuminate\Database\Eloquent\Builder|LogPoleLastState newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LogPoleLastState newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LogPoleLastState query()
 * @method static \Illuminate\Database\Eloquent\Builder|LogPoleLastState whereChangeValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogPoleLastState whereChangeValueCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogPoleLastState whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogPoleLastState whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogPoleLastState whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogPoleLastState whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogPoleLastState whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogPoleLastState whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogPoleLastState whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogPoleLastState wherePoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogPoleLastState whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogPoleLastState whereUpdatedBy($value)
 * @mixin \Eloquent
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
        'pole_id',
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
    public function Pole(): BelongsTo
    {
        return $this->belongsTo(Pole::class, 'id');
    }
}
