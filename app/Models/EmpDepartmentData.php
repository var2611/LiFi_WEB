<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\EmpDepartmentData
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $emp_department_type_id
 * @property string|null $description
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|EmpDepartmentData newModelQuery()
 * @method static Builder|EmpDepartmentData newQuery()
 * @method static Builder|EmpDepartmentData query()
 * @method static Builder|EmpDepartmentData whereCreatedAt($value)
 * @method static Builder|EmpDepartmentData whereCreatedBy($value)
 * @method static Builder|EmpDepartmentData whereDeletedAt($value)
 * @method static Builder|EmpDepartmentData whereDeletedBy($value)
 * @method static Builder|EmpDepartmentData whereDescription($value)
 * @method static Builder|EmpDepartmentData whereEmpDepartmentTypeId($value)
 * @method static Builder|EmpDepartmentData whereId($value)
 * @method static Builder|EmpDepartmentData whereIsActive($value)
 * @method static Builder|EmpDepartmentData whereIsVisible($value)
 * @method static Builder|EmpDepartmentData whereUpdatedAt($value)
 * @method static Builder|EmpDepartmentData whereUpdatedBy($value)
 * @method static Builder|EmpDepartmentData whereUserId($value)
 * @mixin Eloquent
 * @property-read \App\Models\EmpDepartmentType|null $EmpDepartmentType
 */
class EmpDepartmentData extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'emp_department_type_id',
        'description',
        'is_active',
        'is_visible',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];

    public function EmpDepartmentType()
    {
        return $this->belongsTo(EmpDepartmentType::class, 'user_id');
    }
}
