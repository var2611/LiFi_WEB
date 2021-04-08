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

/**
 * App\Models\Pole
 *
 * @property int $id
 * @property string $name
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
 * @property-read Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static Builder|Pole newModelQuery()
 * @method static Builder|Pole newQuery()
 * @method static Builder|Pole query()
 * @method static Builder|Pole whereCreatedAt($value)
 * @method static Builder|Pole whereCreatedBy($value)
 * @method static Builder|Pole whereDeletedAt($value)
 * @method static Builder|Pole whereDeletedBy($value)
 * @method static Builder|Pole whereId($value)
 * @method static Builder|Pole whereIsActive($value)
 * @method static Builder|Pole whereIsVisible($value)
 * @method static Builder|Pole whereName($value)
 * @method static Builder|Pole whereUpdatedAt($value)
 * @method static Builder|Pole whereUpdatedBy($value)
 * @mixin Eloquent
 * @property string $longitude
 * @property string $latitude
 * @property string $location
 * @property string $mac_address
 * @method static Builder|Pole whereLatitude($value)
 * @method static Builder|Pole whereLocation($value)
 * @method static Builder|Pole whereLongitude($value)
 * @method static Builder|Pole whereMacAddress($value)
 * @property int $user_id
 * @method static Builder|Pole whereUserId($value)
 */
class Pole extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


}
