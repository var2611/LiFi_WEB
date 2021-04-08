<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PoleLight
 *
 * @property int $id
 * @property int $pole_id
 * @property int $status
 * @property int $brightness
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|PoleLight newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PoleLight newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PoleLight query()
 * @method static \Illuminate\Database\Eloquent\Builder|PoleLight whereBrightness($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoleLight whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoleLight whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoleLight whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoleLight whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoleLight whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoleLight whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoleLight whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoleLight wherePoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoleLight whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoleLight whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoleLight whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PoleLight extends Model
{
    use HasFactory;
}
