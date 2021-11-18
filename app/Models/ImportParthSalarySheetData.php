<?php


namespace App\Models;


use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


/**
 * App\Models\ImportParthSalarySheetData
 *
 * @property int $id
 * @property string|null $UAN
 * @property string|null $name
 * @property string|null $mobile
 * @property string|null $description
 * @property string|null $date_of_join
 * @property string|null $date_of_birth
 * @property string|null $gender
 * @property string|null $department
 * @property string|null $category
 * @property string|null $minimum_wages
 * @property string|null $days_total
 * @property string|null $holiday
 * @property string|null $days_absent
 * @property string|null $days_working
 * @property string|null $amount_advance_recovery
 * @property string|null $amount_room_rent_excess
 * @property string|null $salary_gross
 * @property string|null $salary_basic
 * @property string|null $salary_hra
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|ImportPublicWifiSeasonData newModelQuery()
 * @method static Builder|ImportPublicWifiSeasonData newQuery()
 * @method static Builder|ImportPublicWifiSeasonData query()
 * @method static Builder|ImportPublicWifiSeasonData whereAmountAdvanceRecovery($value)
 * @method static Builder|ImportPublicWifiSeasonData whereAmountRoomRentExcess($value)
 * @method static Builder|ImportPublicWifiSeasonData whereCategory($value)
 * @method static Builder|ImportPublicWifiSeasonData whereCreatedAt($value)
 * @method static Builder|ImportPublicWifiSeasonData whereCreatedBy($value)
 * @method static Builder|ImportPublicWifiSeasonData whereDateOfBirth($value)
 * @method static Builder|ImportPublicWifiSeasonData whereDateOfJoin($value)
 * @method static Builder|ImportPublicWifiSeasonData whereDaysAbsent($value)
 * @method static Builder|ImportPublicWifiSeasonData whereDaysTotal($value)
 * @method static Builder|ImportPublicWifiSeasonData whereDaysWorking($value)
 * @method static Builder|ImportPublicWifiSeasonData whereDeletedAt($value)
 * @method static Builder|ImportPublicWifiSeasonData whereDeletedBy($value)
 * @method static Builder|ImportPublicWifiSeasonData whereDepartment($value)
 * @method static Builder|ImportPublicWifiSeasonData whereDescription($value)
 * @method static Builder|ImportPublicWifiSeasonData whereGender($value)
 * @method static Builder|ImportPublicWifiSeasonData whereHoliday($value)
 * @method static Builder|ImportPublicWifiSeasonData whereId($value)
 * @method static Builder|ImportPublicWifiSeasonData whereIsActive($value)
 * @method static Builder|ImportPublicWifiSeasonData whereIsVisible($value)
 * @method static Builder|ImportPublicWifiSeasonData whereMinimumWages($value)
 * @method static Builder|ImportPublicWifiSeasonData whereMobile($value)
 * @method static Builder|ImportPublicWifiSeasonData whereName($value)
 * @method static Builder|ImportPublicWifiSeasonData whereSalaryBasic($value)
 * @method static Builder|ImportPublicWifiSeasonData whereSalaryGross($value)
 * @method static Builder|ImportPublicWifiSeasonData whereSalaryHra($value)
 * @method static Builder|ImportPublicWifiSeasonData whereUAN($value)
 * @method static Builder|ImportPublicWifiSeasonData whereUpdatedAt($value)
 * @method static Builder|ImportPublicWifiSeasonData whereUpdatedBy($value)
 * @mixin Eloquent
 */
class ImportParthSalarySheetData extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'UAN',
        'name',
        'mobile',
        'description',
        'date_of_join',
        'date_of_birth',
        'gender',
        'department',
        'category',
        'minimum_wages',
        'days_total',
        'holiday',
        'days_absent',
        'days_working',
        'amount_advance_recovery',
        'amount_room_rent_excess',
        'salary_gross',
        'salary_basic',
        'salary_hra',
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
