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
 * @method static Builder|CompanyHrmsSetting newModelQuery()
 * @method static Builder|CompanyHrmsSetting newQuery()
 * @method static Builder|CompanyHrmsSetting query()
 * @method static Builder|CompanyHrmsSetting whereAddress($value)
 * @method static Builder|CompanyHrmsSetting whereCreatedAt($value)
 * @method static Builder|CompanyHrmsSetting whereCreatedBy($value)
 * @method static Builder|CompanyHrmsSetting whereDeletedAt($value)
 * @method static Builder|CompanyHrmsSetting whereDeletedBy($value)
 * @method static Builder|CompanyHrmsSetting whereGoogleAddress($value)
 * @method static Builder|CompanyHrmsSetting whereId($value)
 * @method static Builder|CompanyHrmsSetting whereIsActive($value)
 * @method static Builder|CompanyHrmsSetting whereIsVisible($value)
 * @method static Builder|CompanyHrmsSetting whereLatitude($value)
 * @method static Builder|CompanyHrmsSetting whereLogo($value)
 * @method static Builder|CompanyHrmsSetting whereLongitude($value)
 * @method static Builder|CompanyHrmsSetting whereName($value)
 * @method static Builder|CompanyHrmsSetting whereShortName($value)
 * @method static Builder|CompanyHrmsSetting whereUpdatedAt($value)
 * @method static Builder|CompanyHrmsSetting whereUpdatedBy($value)
 * @mixin Eloquent
 * @property string|null $background
 * @property string|null $logo_dashboard
 * @method static Builder|CompanyHrmsSetting whereBackground($value)
 * @method static Builder|CompanyHrmsSetting whereLogoDashboard($value)
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
        'background',
        'logo_dashboard',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
        'is_active',
        'is_visible',
    ];
}
