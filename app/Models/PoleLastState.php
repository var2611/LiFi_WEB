<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\PoleLastState
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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read Pole $Pole
 * @method static Builder|PoleLastState newModelQuery()
 * @method static Builder|PoleLastState newQuery()
 * @method static Builder|PoleLastState query()
 * @method static Builder|PoleLastState whereChangeValue($value)
 * @method static Builder|PoleLastState whereChangeValueCode($value)
 * @method static Builder|PoleLastState whereCreatedAt($value)
 * @method static Builder|PoleLastState whereCreatedBy($value)
 * @method static Builder|PoleLastState whereDeletedAt($value)
 * @method static Builder|PoleLastState whereDeletedBy($value)
 * @method static Builder|PoleLastState whereId($value)
 * @method static Builder|PoleLastState whereIsActive($value)
 * @method static Builder|PoleLastState whereIsVisible($value)
 * @method static Builder|PoleLastState wherePoleId($value)
 * @method static Builder|PoleLastState whereUpdatedAt($value)
 * @method static Builder|PoleLastState whereUpdatedBy($value)
 * @mixin Eloquent
 */
class PoleLastState extends Model
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
