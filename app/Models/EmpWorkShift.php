<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\EmpWorkShift
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $start_time
 * @property string|null $end_time
 * @property string|null $hours
 * @property int|null $mon
 * @property int|null $tue
 * @property int|null $wed
 * @property int|null $thur
 * @property int|null $fri
 * @property int|null $sat
 * @property int|null $sun
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|EmpWorkShift newModelQuery()
 * @method static Builder|EmpWorkShift newQuery()
 * @method static Builder|EmpWorkShift query()
 * @method static Builder|EmpWorkShift whereCreatedAt($value)
 * @method static Builder|EmpWorkShift whereCreatedBy($value)
 * @method static Builder|EmpWorkShift whereDeletedAt($value)
 * @method static Builder|EmpWorkShift whereDeletedBy($value)
 * @method static Builder|EmpWorkShift whereDescription($value)
 * @method static Builder|EmpWorkShift whereEndTime($value)
 * @method static Builder|EmpWorkShift whereFri($value)
 * @method static Builder|EmpWorkShift whereHours($value)
 * @method static Builder|EmpWorkShift whereId($value)
 * @method static Builder|EmpWorkShift whereIsActive($value)
 * @method static Builder|EmpWorkShift whereIsVisible($value)
 * @method static Builder|EmpWorkShift whereMon($value)
 * @method static Builder|EmpWorkShift whereName($value)
 * @method static Builder|EmpWorkShift whereSat($value)
 * @method static Builder|EmpWorkShift whereStartTime($value)
 * @method static Builder|EmpWorkShift whereSun($value)
 * @method static Builder|EmpWorkShift whereThur($value)
 * @method static Builder|EmpWorkShift whereTue($value)
 * @method static Builder|EmpWorkShift whereUpdatedAt($value)
 * @method static Builder|EmpWorkShift whereUpdatedBy($value)
 * @method static Builder|EmpWorkShift whereWed($value)
 * @mixin Eloquent
 */
class EmpWorkShift extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_time',
        'end_time',
        'hours',
        'mon',
        'tue',
        'wed',
        'thur',
        'fri',
        'sat',
        'sun',
        'is_active',
        'is_visible',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];
}
