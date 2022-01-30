<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\SalaryAllowanceType
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
 * @method static Builder|SalaryAllowanceType newModelQuery()
 * @method static Builder|SalaryAllowanceType newQuery()
 * @method static Builder|SalaryAllowanceType query()
 * @method static Builder|SalaryAllowanceType whereCreatedAt($value)
 * @method static Builder|SalaryAllowanceType whereCreatedBy($value)
 * @method static Builder|SalaryAllowanceType whereDeletedAt($value)
 * @method static Builder|SalaryAllowanceType whereDeletedBy($value)
 * @method static Builder|SalaryAllowanceType whereId($value)
 * @method static Builder|SalaryAllowanceType whereIsActive($value)
 * @method static Builder|SalaryAllowanceType whereIsVisible($value)
 * @method static Builder|SalaryAllowanceType whereName($value)
 * @method static Builder|SalaryAllowanceType whereUpdatedAt($value)
 * @method static Builder|SalaryAllowanceType whereUpdatedBy($value)
 * @mixin Eloquent
 * @property int|null $company_id
 * @method static Builder|SalaryAllowanceType whereCompanyId($value)
 */
class SalaryAllowanceType extends Model
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
