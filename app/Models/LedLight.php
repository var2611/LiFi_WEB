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
 * App\Models\LedLight
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $status
 * @property int|null $brightness
 * @property int|null $is_active
 * @property int|null $is_visible
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property-read Collection|Client[] $clients
 * @property-read int|null $clients_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static Builder|LedLight newModelQuery()
 * @method static Builder|LedLight newQuery()
 * @method static Builder|LedLight query()
 * @method static Builder|LedLight whereBrightness($value)
 * @method static Builder|LedLight whereCreatedAt($value)
 * @method static Builder|LedLight whereCreatedBy($value)
 * @method static Builder|LedLight whereDeletedAt($value)
 * @method static Builder|LedLight whereDeletedBy($value)
 * @method static Builder|LedLight whereId($value)
 * @method static Builder|LedLight whereIsActive($value)
 * @method static Builder|LedLight whereIsVisible($value)
 * @method static Builder|LedLight whereName($value)
 * @method static Builder|LedLight whereStatus($value)
 * @method static Builder|LedLight whereUpdatedAt($value)
 * @method static Builder|LedLight whereUpdatedBy($value)
 * @mixin Eloquent
 */
class LedLight extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'status',
        'brightness',
        'is_active',
        'is_visible',
    ];
}
