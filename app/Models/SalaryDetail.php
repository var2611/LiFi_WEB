<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\SalaryDetail
 *
 * @property int $id
 * @property int $salary_id
 * @property string|null $name
 * @property string|null $type
 * @property string|null $amount
 * @property string|null $percentage
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Salary $Salary
 * @method static Builder|SalaryDetail newModelQuery()
 * @method static Builder|SalaryDetail newQuery()
 * @method static Builder|SalaryDetail query()
 * @method static Builder|SalaryDetail whereAmount($value)
 * @method static Builder|SalaryDetail whereCreatedAt($value)
 * @method static Builder|SalaryDetail whereCreatedBy($value)
 * @method static Builder|SalaryDetail whereDeletedAt($value)
 * @method static Builder|SalaryDetail whereDeletedBy($value)
 * @method static Builder|SalaryDetail whereId($value)
 * @method static Builder|SalaryDetail whereIsActive($value)
 * @method static Builder|SalaryDetail whereIsVisible($value)
 * @method static Builder|SalaryDetail whereName($value)
 * @method static Builder|SalaryDetail wherePercentage($value)
 * @method static Builder|SalaryDetail whereSalaryId($value)
 * @method static Builder|SalaryDetail whereType($value)
 * @method static Builder|SalaryDetail whereUpdatedAt($value)
 * @method static Builder|SalaryDetail whereUpdatedBy($value)
 * @mixin Eloquent
 */
class SalaryDetail extends Model
{
    protected $fillable = [
        'salary_id',
        'name',
        'type',
        'amount',
        'percentage',
        'is_active',
        'is_visible',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];

    public function Salary(): BelongsTo
    {
        return $this->belongsTo(Salary::class, 'id');
    }

}
