<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Holiday
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $date
 * @property int|null $company_id
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|Holiday newModelQuery()
 * @method static Builder|Holiday newQuery()
 * @method static Builder|Holiday query()
 * @method static Builder|Holiday whereCompanyId($value)
 * @method static Builder|Holiday whereCreatedAt($value)
 * @method static Builder|Holiday whereCreatedBy($value)
 * @method static Builder|Holiday whereDate($value)
 * @method static Builder|Holiday whereDeletedAt($value)
 * @method static Builder|Holiday whereDeletedBy($value)
 * @method static Builder|Holiday whereDescription($value)
 * @method static Builder|Holiday whereId($value)
 * @method static Builder|Holiday whereIsActive($value)
 * @method static Builder|Holiday whereIsVisible($value)
 * @method static Builder|Holiday whereName($value)
 * @method static Builder|Holiday whereUpdatedAt($value)
 * @method static Builder|Holiday whereUpdatedBy($value)
 * @mixin Eloquent
 */
class Holiday extends Model
{
    protected $fillable = array(
        'name',
        'description',
        'date',
        'company_id',
        'is_active',
        'is_visible',
        'created_by',
        'updated_by',
        'deleted_by',
    );

}
