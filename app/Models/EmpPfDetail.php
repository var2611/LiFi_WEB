<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\EmpPfDetail
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $bank_name
 * @property string|null $description
 * @property string|null $account_number
 * @property string|null $status
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|EmpPfDetail newModelQuery()
 * @method static Builder|EmpPfDetail newQuery()
 * @method static Builder|EmpPfDetail query()
 * @method static Builder|EmpPfDetail whereAccountNumber($value)
 * @method static Builder|EmpPfDetail whereBankName($value)
 * @method static Builder|EmpPfDetail whereCreatedAt($value)
 * @method static Builder|EmpPfDetail whereCreatedBy($value)
 * @method static Builder|EmpPfDetail whereDeletedAt($value)
 * @method static Builder|EmpPfDetail whereDeletedBy($value)
 * @method static Builder|EmpPfDetail whereDescription($value)
 * @method static Builder|EmpPfDetail whereId($value)
 * @method static Builder|EmpPfDetail whereIsActive($value)
 * @method static Builder|EmpPfDetail whereIsVisible($value)
 * @method static Builder|EmpPfDetail whereStatus($value)
 * @method static Builder|EmpPfDetail whereUpdatedAt($value)
 * @method static Builder|EmpPfDetail whereUpdatedBy($value)
 * @method static Builder|EmpPfDetail whereUserId($value)
 * @mixin Eloquent
 */
class EmpPfDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'account_number',
        'bank_name',
        'description',
        'status',
        'is_visible',
        'is_active',
        'updated_by',
        'created_by',
        'deleted_by',
        'deleted_at',
    ];
}
