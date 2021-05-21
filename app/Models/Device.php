<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Passport\Client;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\Token;

/**
 * App\Models\Device
 *
 * @property int $id
 * @property string|null $name
 * @property int $user_id
 * @property int $device_type_id
 * @property string|null $mac_address
 * @property string|null $location
 * @property string|null $latitude
 * @property string|null $longitude
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read Collection|Client[] $clients
 * @property-read int|null $clients_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static Builder|Device newModelQuery()
 * @method static Builder|Device newQuery()
 * @method static Builder|Device query()
 * @method static Builder|Device whereCreatedAt($value)
 * @method static Builder|Device whereCreatedBy($value)
 * @method static Builder|Device whereDeletedAt($value)
 * @method static Builder|Device whereDeletedBy($value)
 * @method static Builder|Device whereDeviceTypeId($value)
 * @method static Builder|Device whereId($value)
 * @method static Builder|Device whereIsActive($value)
 * @method static Builder|Device whereIsVisible($value)
 * @method static Builder|Device whereLatitude($value)
 * @method static Builder|Device whereLocation($value)
 * @method static Builder|Device whereLongitude($value)
 * @method static Builder|Device whereMacAddress($value)
 * @method static Builder|Device whereName($value)
 * @method static Builder|Device whereUpdatedAt($value)
 * @method static Builder|Device whereUpdatedBy($value)
 * @method static Builder|Device whereUserId($value)
 * @mixin Eloquent
 */
class Device extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'user_id',
        'device_type_id',
        'mac_address',
        'location',
        'longitude',
        'latitude',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
        'is_active',
        'is_visible',
    ];
}
