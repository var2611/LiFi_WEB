<?php


namespace App\Models;


use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\UserEmployee
 *
 * @property int $id
 * @property int $user_id
 * @property int $user_role_id
 * @property string $emp_code
 * @property string $flash_code
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|UserEmployee newModelQuery()
 * @method static Builder|UserEmployee newQuery()
 * @method static Builder|UserEmployee query()
 * @method static Builder|UserEmployee whereCreatedAt($value)
 * @method static Builder|UserEmployee whereCreatedBy($value)
 * @method static Builder|UserEmployee whereDeletedAt($value)
 * @method static Builder|UserEmployee whereDeletedBy($value)
 * @method static Builder|UserEmployee whereEmpCode($value)
 * @method static Builder|UserEmployee whereFlashCode($value)
 * @method static Builder|UserEmployee whereId($value)
 * @method static Builder|UserEmployee whereIsActive($value)
 * @method static Builder|UserEmployee whereIsVisible($value)
 * @method static Builder|UserEmployee whereUpdatedAt($value)
 * @method static Builder|UserEmployee whereUpdatedBy($value)
 * @method static Builder|UserEmployee whereUserId($value)
 * @method static Builder|UserEmployee whereUserRoleId($value)
 * @mixin Eloquent
 * @property-read User $User
 * @property-read UserRole $UserRole
 * @property int $company_id
 * @method static Builder|UserEmployee whereCompanyId($value)
 * @property-read CompanyHrmsSetting $Company
 * @property-read EmpDepartmentData $EmpDepartmentData
 * @property-read EmpPfDetail|null $EmpPfDetail
 * @property string|null $gender
 * @method static Builder|UserEmployee whereGender($value)
 */
class UserEmployee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_role_id',
        'emp_code',
        'id_photo',
        'gender',
        'date_of_joining',
        'emp_department_type_id',
        'blood_group',
        'date_of_birth',
        'flash_code',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
        'is_active',
        'is_visible',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function EmpDepartmentData(): HasOne
    {
        return $this->hasOne(EmpDepartmentData::class, 'user_id', 'user_id');
    }

    public function UserRole(): BelongsTo
    {
        return $this->belongsTo(UserRole::class, 'user_role_id');
    }

    public function Company(): BelongsTo
    {
        return $this->belongsTo(CompanyHrmsSetting::class, 'company_id');
    }

    public function EmpDepartmentType(): HasOne
    {
        return $this->hasOne(EmpDepartmentType::class, 'id', 'emp_department_type_id');
    }

    public function EmpPfDetail(): HasOne
    {
        return $this->hasOne(EmpPfDetail::class, 'user_id', 'user_id');
    }


}
