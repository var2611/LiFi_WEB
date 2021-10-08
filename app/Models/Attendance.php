<?php


namespace App\Models;


use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Attendance
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $flash_code
 * @property string $date
 * @property string|null $in_time
 * @property string|null $out_time
 * @property string|null $hours_worked
 * @property string|null $difference
 * @property int $status
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|Attendance newModelQuery()
 * @method static Builder|Attendance newQuery()
 * @method static Builder|Attendance query()
 * @method static Builder|Attendance whereCreatedAt($value)
 * @method static Builder|Attendance whereCreatedBy($value)
 * @method static Builder|Attendance whereDate($value)
 * @method static Builder|Attendance whereDeletedAt($value)
 * @method static Builder|Attendance whereDeletedBy($value)
 * @method static Builder|Attendance whereDifference($value)
 * @method static Builder|Attendance whereFlashCode($value)
 * @method static Builder|Attendance whereHoursWorked($value)
 * @method static Builder|Attendance whereId($value)
 * @method static Builder|Attendance whereInTime($value)
 * @method static Builder|Attendance whereIsActive($value)
 * @method static Builder|Attendance whereIsVisible($value)
 * @method static Builder|Attendance whereName($value)
 * @method static Builder|Attendance whereOutTime($value)
 * @method static Builder|Attendance whereStatus($value)
 * @method static Builder|Attendance whereUpdatedAt($value)
 * @method static Builder|Attendance whereUpdatedBy($value)
 * @method static Builder|Attendance whereUserId($value)
 * @mixin Eloquent
 * @property-read User $User
 * @property string|null $break_in_time
 * @property int|null $break_out_time
 * @property string|null $break_time
 * @method static Builder|Attendance whereBreakInTime($value)
 * @method static Builder|Attendance whereBreakOutTime($value)
 * @method static Builder|Attendance whereBreakTime($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AttBreak[] $AttBreak
 * @property-read int|null $att_break_count
 */
class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'flash_code',
        'date',
        'in_time',
        'out_time',
        'hours_worked',
        'break_time',
        'difference',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
        'is_active',
        'is_visible',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function AttBreak(): HasMany
    {
        return $this->hasMany(AttBreak::class, 'attendance_id');
    }
}
