<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ImportLatLongInternetData
 *
 * @property int $id
 * @property string|null $name
 * @property float|null $latitude
 * @property float|null $longitude
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|ImportLatLongInternetData newModelQuery()
 * @method static Builder|ImportLatLongInternetData newQuery()
 * @method static Builder|ImportLatLongInternetData query()
 * @method static Builder|ImportLatLongInternetData whereCreatedAt($value)
 * @method static Builder|ImportLatLongInternetData whereCreatedBy($value)
 * @method static Builder|ImportLatLongInternetData whereDeletedAt($value)
 * @method static Builder|ImportLatLongInternetData whereDeletedBy($value)
 * @method static Builder|ImportLatLongInternetData whereId($value)
 * @method static Builder|ImportLatLongInternetData whereIsActive($value)
 * @method static Builder|ImportLatLongInternetData whereIsVisible($value)
 * @method static Builder|ImportLatLongInternetData whereLatitude($value)
 * @method static Builder|ImportLatLongInternetData whereLongitude($value)
 * @method static Builder|ImportLatLongInternetData whereName($value)
 * @method static Builder|ImportLatLongInternetData whereUpdatedAt($value)
 * @method static Builder|ImportLatLongInternetData whereUpdatedBy($value)
 * @mixin \Eloquent
 * @property string|null $group_id
 * @property string|null $block
 * @property string|null $district
 * @property string|null $zone
 * @property string|null $state
 * @property string|null $file_name
 * @method static Builder|ImportLatLongInternetData whereBlock($value)
 * @method static Builder|ImportLatLongInternetData whereDistrict($value)
 * @method static Builder|ImportLatLongInternetData whereFileName($value)
 * @method static Builder|ImportLatLongInternetData whereGroupId($value)
 * @method static Builder|ImportLatLongInternetData whereState($value)
 * @method static Builder|ImportLatLongInternetData whereZone($value)
 */
class ImportLatLongInternetData extends Model
{

    use HasFactory;

    protected $fillable = [
        'group_id',
        'name',
        'latitude',
        'longitude',
        'block',
        'district',
        'zone',
        'state',
        'file_name',
        'is_active',
        'is_visible',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
