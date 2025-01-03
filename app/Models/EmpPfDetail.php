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
 * @property string|null $uan
 * @method static Builder|EmpPfDetail whereUan($value)
 * @property string|null $pf_number
 * @method static Builder|EmpPfDetail wherePfNumber($value)
 * @property-read User $User
 * @property-read UserEmployee|null $UserEmployee
 * @property int|null $abry_eligible
 * @method static Builder|EmpPfDetail whereAbryEligible($value)
 */
class EmpPfDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'account_number',
        'uan',
        'bank_name',
        'description',
        'status',
        'abry_eligible',
        'is_visible',
        'is_active',
        'updated_by',
        'created_by',
        'deleted_by',
        'deleted_at',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function UserEmployee(): HasOne
    {
        return $this->hasOne(UserEmployee::class, 'user_id', 'user_id');
    }
}
