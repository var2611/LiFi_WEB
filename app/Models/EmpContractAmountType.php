<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\EmpContractAmountType
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
 * @method static Builder|EmpContractAmountType newModelQuery()
 * @method static Builder|EmpContractAmountType newQuery()
 * @method static Builder|EmpContractAmountType query()
 * @method static Builder|EmpContractAmountType whereCreatedAt($value)
 * @method static Builder|EmpContractAmountType whereCreatedBy($value)
 * @method static Builder|EmpContractAmountType whereDeletedAt($value)
 * @method static Builder|EmpContractAmountType whereDeletedBy($value)
 * @method static Builder|EmpContractAmountType whereId($value)
 * @method static Builder|EmpContractAmountType whereIsActive($value)
 * @method static Builder|EmpContractAmountType whereIsVisible($value)
 * @method static Builder|EmpContractAmountType whereName($value)
 * @method static Builder|EmpContractAmountType whereUpdatedAt($value)
 * @method static Builder|EmpContractAmountType whereUpdatedBy($value)
 * @mixin Eloquent
 */
class EmpContractAmountType extends Model
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
