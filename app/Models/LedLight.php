<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * App\Models\LedLight
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $status
 * @property int|null $brightness
 * @property int|null $is_active
 * @property int|null $is_visible
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|LedLight newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LedLight newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LedLight query()
 * @method static \Illuminate\Database\Eloquent\Builder|LedLight whereBrightness($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LedLight whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LedLight whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LedLight whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LedLight whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LedLight whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LedLight whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LedLight whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LedLight whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LedLight whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LedLight whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LedLight whereUpdatedBy($value)
 * @mixin \Eloquent
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
