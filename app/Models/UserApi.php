<?php


namespace App\Models;


use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\UserAPI
 *
 * @property-read CompanyHrmsSetting $Company
 * @property-read User $User
 * @property-read UserRole $UserRole
 * @method static Builder|UserApi newModelQuery()
 * @method static Builder|UserApi newQuery()
 * @method static Builder|UserApi query()
 * @mixin Eloquent
 * @property int $id
 * @property int $user_id
 * @property int $user_role_id
 * @property int $company_id
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|UserApi whereCompanyId($value)
 * @method static Builder|UserApi whereCreatedAt($value)
 * @method static Builder|UserApi whereCreatedBy($value)
 * @method static Builder|UserApi whereDeletedAt($value)
 * @method static Builder|UserApi whereDeletedBy($value)
 * @method static Builder|UserApi whereId($value)
 * @method static Builder|UserApi whereIsActive($value)
 * @method static Builder|UserApi whereIsVisible($value)
 * @method static Builder|UserApi whereUpdatedAt($value)
 * @method static Builder|UserApi whereUpdatedBy($value)
 * @method static Builder|UserApi whereUserId($value)
 * @method static Builder|UserApi whereUserRoleId($value)
 */
class UserApi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_role_id',
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

    public function UserRole(): BelongsTo
    {
        return $this->belongsTo(UserRole::class, 'user_role_id');
    }

    public function Company(): BelongsTo
    {
        return $this->belongsTo(CompanyHrmsSetting::class, 'company_id');
    }
}
