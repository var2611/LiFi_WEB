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
 * @method static Builder|EmpDepartmentType newModelQuery()
 * @method static Builder|EmpDepartmentType newQuery()
 * @method static Builder|EmpDepartmentType query()
 * @method static Builder|EmpDepartmentType whereCreatedAt($value)
 * @method static Builder|EmpDepartmentType whereCreatedBy($value)
 * @method static Builder|EmpDepartmentType whereDeletedAt($value)
 * @method static Builder|EmpDepartmentType whereDeletedBy($value)
 * @method static Builder|EmpDepartmentType whereId($value)
 * @method static Builder|EmpDepartmentType whereIsActive($value)
 * @method static Builder|EmpDepartmentType whereIsVisible($value)
 * @method static Builder|EmpDepartmentType whereName($value)
 * @method static Builder|EmpDepartmentType whereUpdatedAt($value)
 * @method static Builder|EmpDepartmentType whereUpdatedBy($value)
 * @mixin Eloquent
 */
class EmpDepartmentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_active',
        'is_visible',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];
}
