<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\ImportLatLongNonInternetData
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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|ImportLatLongNonInternetData newModelQuery()
 * @method static Builder|ImportLatLongNonInternetData newQuery()
 * @method static Builder|ImportLatLongNonInternetData query()
 * @method static Builder|ImportLatLongNonInternetData whereCreatedAt($value)
 * @method static Builder|ImportLatLongNonInternetData whereCreatedBy($value)
 * @method static Builder|ImportLatLongNonInternetData whereDeletedAt($value)
 * @method static Builder|ImportLatLongNonInternetData whereDeletedBy($value)
 * @method static Builder|ImportLatLongNonInternetData whereId($value)
 * @method static Builder|ImportLatLongNonInternetData whereIsActive($value)
 * @method static Builder|ImportLatLongNonInternetData whereIsVisible($value)
 * @method static Builder|ImportLatLongNonInternetData whereLatitude($value)
 * @method static Builder|ImportLatLongNonInternetData whereLongitude($value)
 * @method static Builder|ImportLatLongNonInternetData whereName($value)
 * @method static Builder|ImportLatLongNonInternetData whereUpdatedAt($value)
 * @method static Builder|ImportLatLongNonInternetData whereUpdatedBy($value)
 * @mixin \Eloquent
 * @property string|null $group_id
 * @property string|null $block
 * @property string|null $district
 * @property string|null $zone
 * @property string|null $state
 * @property string|null $file_name
 * @method static Builder|ImportLatLongNonInternetData whereBlock($value)
 * @method static Builder|ImportLatLongNonInternetData whereDistrict($value)
 * @method static Builder|ImportLatLongNonInternetData whereFileName($value)
 * @method static Builder|ImportLatLongNonInternetData whereGroupId($value)
 * @method static Builder|ImportLatLongNonInternetData whereState($value)
 * @method static Builder|ImportLatLongNonInternetData whereZone($value)
 */
class ImportLatLongNonInternetData extends Model
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
