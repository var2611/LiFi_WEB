<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\Token;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Client[] $clients
 * @property-read int|null $clients_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin Eloquent
 * @property string|null $razor_customer_id
 * @property string|null $mobile
 * @property mixed|null $firebase_token
 * @property int|null $is_active
 * @property int|null $is_visible
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @method static Builder|User whereCreatedBy($value)
 * @method static Builder|User whereDeletedAt($value)
 * @method static Builder|User whereDeletedBy($value)
 * @method static Builder|User whereFirebaseToken($value)
 * @method static Builder|User whereIsActive($value)
 * @method static Builder|User whereIsVisible($value)
 * @method static Builder|User whereMobile($value)
 * @method static Builder|User whereRazorCustomerId($value)
 * @method static Builder|User whereUpdatedBy($value)
 * @property string|null $mac_address For Pole Only
 * @method static Builder|User whereMacAddress($value)
 * @property-read User|null $createdBy
 * @property-read UserEmployee|null $UserEmployee
 * @property string|null $last_name
 * @method static Builder|User whereLastName($value)
 * @method static UserFactory factory(...$parameters)
 * @property-read UserApi|null $UserApi
 * @property string|null $adhar_number For HRMS User who has no mobile or email
 * @method static Builder|User whereAdharNumber($value)
 * @property string|null $middle_name
 * @method static Builder|User whereMiddleName($value)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'middle_name',
        'last_name',
        'mobile',
        'email',
        'adhar_number',
        'password',
        'firebase_token',
        'mac_address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Set as username any column from users table
    public function findForPassport($username)
    {
        $customUsername = 'mac_address';
        return $this->where($customUsername, $username)->first();
    }

    public function UserEmployee(): HasOne
    {
        return $this->hasOne(UserEmployee::class, 'user_id');
    }

    public function UserApi(): HasOne
    {
        return $this->hasOne(UserApi::class, 'user_id');
    }

    /**
     * @return bool
     */
    public function isHR(): bool
    {
        $userRole = Auth::user()->UserEmployee->user_role_id;
        return $userRole == 3;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        $userRole = Auth::user()->UserEmployee->user_role_id;
        return $userRole == 1;
    }


    /**
     * @return bool
     */
    public function isArmy(): bool
    {
        $userRole = Auth::user()->UserEmployee->user_role_id;
        return $userRole == 6;
    }


    /**
     * @return bool
     */
    public function isFreeLiFiWiFi(): bool
    {
        $companyId = Auth::user()->getCompanyId();
        return $companyId == 5;
    }

    public function getCompanyId(): ?int
    {
        if (Auth::user()->UserEmployee)
            return Auth::user()->UserEmployee->company_id;
        elseif (Auth::user()->UserApi)
            return Auth::user()->UserApi->company_id;
        else
            return null;
    }

    /**
     * @return Company|Builder
     */
    public function getCompanyData(): ?Company
    {
        return Company::whereId($this->getCompanyId())->first() ?? null;
    }

    public function getFullName(): string
    {
        return $this->name . ' '. ($this->middle_name ? $this->middle_name . ' ' : '') . $this->last_name;
    }
}
