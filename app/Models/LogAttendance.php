<?php


namespace App\Models;


use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\LogAttendance
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $flash_code
 * @property string $date
 * @property string|null $punch_time
 * @property int $status
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read User $User
 * @method static Builder|LogAttendance newModelQuery()
 * @method static Builder|LogAttendance newQuery()
 * @method static Builder|LogAttendance query()
 * @method static Builder|LogAttendance whereCreatedAt($value)
 * @method static Builder|LogAttendance whereCreatedBy($value)
 * @method static Builder|LogAttendance whereDate($value)
 * @method static Builder|LogAttendance whereDeletedAt($value)
 * @method static Builder|LogAttendance whereDeletedBy($value)
 * @method static Builder|LogAttendance whereFlashCode($value)
 * @method static Builder|LogAttendance whereId($value)
 * @method static Builder|LogAttendance whereIsActive($value)
 * @method static Builder|LogAttendance whereIsVisible($value)
 * @method static Builder|LogAttendance whereName($value)
 * @method static Builder|LogAttendance wherePunchTime($value)
 * @method static Builder|LogAttendance whereStatus($value)
 * @method static Builder|LogAttendance whereUpdatedAt($value)
 * @method static Builder|LogAttendance whereUpdatedBy($value)
 * @method static Builder|LogAttendance whereUserId($value)
 * @mixin Eloquent
 */
class LogAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'flash_code',
        'date',
        'punch_time',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
        'is_active',
        'is_visible',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
