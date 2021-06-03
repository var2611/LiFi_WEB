<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\AttendanceData
 *
 * @property int $attendance_id
 * @property int|null $user_id
 * @property string|null $user_name
 * @property string|null $mobile
 * @property string|null $email
 * @property string|null $emp_code
 * @property string|null $user_flash_code
 * @property string $att_flash_code
 * @property string|null $role_name
 * @property int|null $company_id
 * @property string|null $company_name
 * @property string $date
 * @property string|null $in_time
 * @property string|null $out_time
 * @property string|null $hours_worked
 * @property string|null $difference
 * @property int $status
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property string|null $att_created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property string|null $att_updated_by
 * @method static Builder|AttendanceData newModelQuery()
 * @method static Builder|AttendanceData newQuery()
 * @method static Builder|AttendanceData query()
 * @method static Builder|AttendanceData whereAttCreatedBy($value)
 * @method static Builder|AttendanceData whereAttFlashCode($value)
 * @method static Builder|AttendanceData whereAttUpdatedBy($value)
 * @method static Builder|AttendanceData whereAttendanceId($value)
 * @method static Builder|AttendanceData whereCompanyId($value)
 * @method static Builder|AttendanceData whereCompanyName($value)
 * @method static Builder|AttendanceData whereCreatedAt($value)
 * @method static Builder|AttendanceData whereCreatedBy($value)
 * @method static Builder|AttendanceData whereDate($value)
 * @method static Builder|AttendanceData whereDifference($value)
 * @method static Builder|AttendanceData whereEmail($value)
 * @method static Builder|AttendanceData whereEmpCode($value)
 * @method static Builder|AttendanceData whereHoursWorked($value)
 * @method static Builder|AttendanceData whereInTime($value)
 * @method static Builder|AttendanceData whereMobile($value)
 * @method static Builder|AttendanceData whereOutTime($value)
 * @method static Builder|AttendanceData whereRoleName($value)
 * @method static Builder|AttendanceData whereStatus($value)
 * @method static Builder|AttendanceData whereUpdatedAt($value)
 * @method static Builder|AttendanceData whereUpdatedBy($value)
 * @method static Builder|AttendanceData whereUserFlashCode($value)
 * @method static Builder|AttendanceData whereUserId($value)
 * @method static Builder|AttendanceData whereUserName($value)
 * @mixin \Eloquent
 * @property int $id
 * @method static Builder|AttendanceData whereId($value)
 */
class AttendanceData extends Model
{

}
