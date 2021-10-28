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
 * @method static Builder|ImportParthSalarySheetData newModelQuery()
 * @method static Builder|ImportParthSalarySheetData newQuery()
 * @method static Builder|ImportParthSalarySheetData query()
 * @method static Builder|ImportParthSalarySheetData whereAmountAdvanceRecovery($value)
 * @method static Builder|ImportParthSalarySheetData whereAmountRoomRentExcess($value)
 * @method static Builder|ImportParthSalarySheetData whereCategory($value)
 * @method static Builder|ImportParthSalarySheetData whereCreatedAt($value)
 * @method static Builder|ImportParthSalarySheetData whereCreatedBy($value)
 * @method static Builder|ImportParthSalarySheetData whereDateOfBirth($value)
 * @method static Builder|ImportParthSalarySheetData whereDateOfJoin($value)
 * @method static Builder|ImportParthSalarySheetData whereDaysAbsent($value)
 * @method static Builder|ImportParthSalarySheetData whereDaysTotal($value)
 * @method static Builder|ImportParthSalarySheetData whereDaysWorking($value)
 * @method static Builder|ImportParthSalarySheetData whereDeletedAt($value)
 * @method static Builder|ImportParthSalarySheetData whereDeletedBy($value)
 * @method static Builder|ImportParthSalarySheetData whereDepartment($value)
 * @method static Builder|ImportParthSalarySheetData whereDescription($value)
 * @method static Builder|ImportParthSalarySheetData whereGender($value)
 * @method static Builder|ImportParthSalarySheetData whereHoliday($value)
 * @method static Builder|ImportParthSalarySheetData whereId($value)
 * @method static Builder|ImportParthSalarySheetData whereIsActive($value)
 * @method static Builder|ImportParthSalarySheetData whereIsVisible($value)
 * @method static Builder|ImportParthSalarySheetData whereMinimumWages($value)
 * @method static Builder|ImportParthSalarySheetData whereMobile($value)
 * @method static Builder|ImportParthSalarySheetData whereName($value)
 * @method static Builder|ImportParthSalarySheetData whereSalaryBasic($value)
 * @method static Builder|ImportParthSalarySheetData whereSalaryGross($value)
 * @method static Builder|ImportParthSalarySheetData whereSalaryHra($value)
 * @method static Builder|ImportParthSalarySheetData whereUAN($value)
 * @method static Builder|ImportParthSalarySheetData whereUpdatedAt($value)
 * @method static Builder|ImportParthSalarySheetData whereUpdatedBy($value)
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
