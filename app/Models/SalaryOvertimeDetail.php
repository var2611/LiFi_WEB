<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\SalaryOvertimeDetail
 *
 * @property int $id
 * @property int $salary_id
 * @property int $attendances_id
 * @property int $overtime_type_id
 * @property string|null $date
 * @property string|null $type
 * @property string|null $description
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read OvertimeType $OvertimeType
 * @property-read Salary $Salary
 * @method static Builder|SalaryOvertimeDetail newModelQuery()
 * @method static Builder|SalaryOvertimeDetail newQuery()
 * @method static Builder|SalaryOvertimeDetail query()
 * @method static Builder|SalaryOvertimeDetail whereAttendancesId($value)
 * @method static Builder|SalaryOvertimeDetail whereCreatedAt($value)
 * @method static Builder|SalaryOvertimeDetail whereCreatedBy($value)
 * @method static Builder|SalaryOvertimeDetail whereDate($value)
 * @method static Builder|SalaryOvertimeDetail whereDeletedAt($value)
 * @method static Builder|SalaryOvertimeDetail whereDeletedBy($value)
 * @method static Builder|SalaryOvertimeDetail whereDescription($value)
 * @method static Builder|SalaryOvertimeDetail whereId($value)
 * @method static Builder|SalaryOvertimeDetail whereIsActive($value)
 * @method static Builder|SalaryOvertimeDetail whereIsVisible($value)
 * @method static Builder|SalaryOvertimeDetail whereOvertimeTypeId($value)
 * @method static Builder|SalaryOvertimeDetail whereSalaryId($value)
 * @method static Builder|SalaryOvertimeDetail whereType($value)
 * @method static Builder|SalaryOvertimeDetail whereUpdatedAt($value)
 * @method static Builder|SalaryOvertimeDetail whereUpdatedBy($value)
 * @mixin Eloquent
 */
class SalaryOvertimeDetail extends Model
{
    protected $fillable = [
        'salary_id',
        'attendances_id',
        'overtime_type_id',
        'date',
        'type',
        'description',
        'is_active',
        'is_visible',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];

    public function Salary(): BelongsTo
    {
        return $this->belongsTo(Salary::class, 'id');
    }

    public function OvertimeType(): BelongsTo
    {
        return $this->belongsTo(OvertimeType::class, 'id');
    }

}
