<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\EmpContractStatus
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|EmpContractStatus newModelQuery()
 * @method static Builder|EmpContractStatus newQuery()
 * @method static Builder|EmpContractStatus query()
 * @method static Builder|EmpContractStatus whereCreatedAt($value)
 * @method static Builder|EmpContractStatus whereCreatedBy($value)
 * @method static Builder|EmpContractStatus whereDeletedAt($value)
 * @method static Builder|EmpContractStatus whereDeletedBy($value)
 * @method static Builder|EmpContractStatus whereDescription($value)
 * @method static Builder|EmpContractStatus whereId($value)
 * @method static Builder|EmpContractStatus whereIsActive($value)
 * @method static Builder|EmpContractStatus whereIsVisible($value)
 * @method static Builder|EmpContractStatus whereName($value)
 * @method static Builder|EmpContractStatus whereUpdatedAt($value)
 * @method static Builder|EmpContractStatus whereUpdatedBy($value)
 * @mixin Eloquent
 */
class EmpContractStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_active',
        'is_visible',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];
}
