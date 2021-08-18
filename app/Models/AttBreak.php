<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\AttBreak
 *
 * @property-read Attendance $Attendance
 * @method static Builder|AttBreak newModelQuery()
 * @method static Builder|AttBreak newQuery()
 * @method static Builder|AttBreak query()
 * @mixin Eloquent
 * @property int $id
 * @property int $attendance_id
 * @property string $flash_code
 * @property string $date
 * @property string|null $break_in_time
 * @property string|null $break_out_time
 * @property string|null $break_time
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|AttBreak whereAttendanceId($value)
 * @method static Builder|AttBreak whereBreakInTime($value)
 * @method static Builder|AttBreak whereBreakOutTime($value)
 * @method static Builder|AttBreak whereBreakTime($value)
 * @method static Builder|AttBreak whereCreatedAt($value)
 * @method static Builder|AttBreak whereCreatedBy($value)
 * @method static Builder|AttBreak whereDate($value)
 * @method static Builder|AttBreak whereDeletedAt($value)
 * @method static Builder|AttBreak whereDeletedBy($value)
 * @method static Builder|AttBreak whereFlashCode($value)
 * @method static Builder|AttBreak whereId($value)
 * @method static Builder|AttBreak whereIsActive($value)
 * @method static Builder|AttBreak whereIsVisible($value)
 * @method static Builder|AttBreak whereUpdatedAt($value)
 * @method static Builder|AttBreak whereUpdatedBy($value)
 */
class AttBreak extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attendance_id',
        'flash_code',
        'date',
        'break_in_time',
        'break_out_time',
        'break_time',
        'is_active',
        'is_visible',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
        'is_active',
        'is_visible',
    ];

    /**
     * @return BelongsTo
     */
    public function Attendance(): BelongsTo
    {
        return $this->belongsTo(Attendance::class, 'id');
    }
}
