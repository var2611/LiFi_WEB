<?php


namespace App\Models;


use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Company
 *
 * @property int $id
 * @property string $name
 * @property string|null $short_name
 * @property mixed|null $address
 * @property mixed|null $google_address
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $logo
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|Company newModelQuery()
 * @method static Builder|Company newQuery()
 * @method static Builder|Company query()
 * @method static Builder|Company whereAddress($value)
 * @method static Builder|Company whereCreatedAt($value)
 * @method static Builder|Company whereCreatedBy($value)
 * @method static Builder|Company whereDeletedAt($value)
 * @method static Builder|Company whereDeletedBy($value)
 * @method static Builder|Company whereGoogleAddress($value)
 * @method static Builder|Company whereId($value)
 * @method static Builder|Company whereIsActive($value)
 * @method static Builder|Company whereIsVisible($value)
 * @method static Builder|Company whereLatitude($value)
 * @method static Builder|Company whereLogo($value)
 * @method static Builder|Company whereLongitude($value)
 * @method static Builder|Company whereName($value)
 * @method static Builder|Company whereShortName($value)
 * @method static Builder|Company whereUpdatedAt($value)
 * @method static Builder|Company whereUpdatedBy($value)
 * @mixin Eloquent
 */
class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_name',
        'address',
        'google_address',
        'latitude',
        'longitude',
        'logo',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
        'is_active',
        'is_visible',
    ];
}
