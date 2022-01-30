<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\EmpDepartmentType
 *
 * @property int $id
 * @property string|null $name
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
 * @method static Builder|EmpDepartmentData whereId($value)
 * @method static Builder|EmpDepartmentData whereIsActive($value)
 * @method static Builder|EmpDepartmentData whereIsVisible($value)
 * @method static Builder|EmpDepartmentData whereName($value)
 * @method static Builder|EmpDepartmentData whereUpdatedAt($value)
 * @method static Builder|EmpDepartmentData whereUpdatedBy($value)
 * @mixin Eloquent
 * @property int|null $company_id
 * @method static Builder|EmpDepartmentType whereCompanyId($value)
 */
class EmpDepartmentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'is_active',
        'is_visible',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];
}
