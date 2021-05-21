<?php


namespace App\Models;


use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\UserRole
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
 * @method static Builder|UserRole newModelQuery()
 * @method static Builder|UserRole newQuery()
 * @method static Builder|UserRole query()
 * @method static Builder|UserRole whereCreatedAt($value)
 * @method static Builder|UserRole whereCreatedBy($value)
 * @method static Builder|UserRole whereDeletedAt($value)
 * @method static Builder|UserRole whereDeletedBy($value)
 * @method static Builder|UserRole whereId($value)
 * @method static Builder|UserRole whereIsActive($value)
 * @method static Builder|UserRole whereIsVisible($value)
 * @method static Builder|UserRole whereName($value)
 * @method static Builder|UserRole whereUpdatedAt($value)
 * @method static Builder|UserRole whereUpdatedBy($value)
 * @mixin Eloquent
 */
class UserRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
        'is_active',
        'is_visible',
    ];
}
