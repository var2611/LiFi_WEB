<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\EmpContract
 *
 * @property int $id
 * @property int $user_employee_id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $date
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $days
 * @property string|null $status
 * @property int|null $emp_contract_amount_type_id
 * @property string|null $amount
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|EmpContract newModelQuery()
 * @method static Builder|EmpContract newQuery()
 * @method static Builder|EmpContract query()
 * @method static Builder|EmpContract whereAmount($value)
 * @method static Builder|EmpContract whereCreatedAt($value)
 * @method static Builder|EmpContract whereCreatedBy($value)
 * @method static Builder|EmpContract whereDate($value)
 * @method static Builder|EmpContract whereDays($value)
 * @method static Builder|EmpContract whereDeletedAt($value)
 * @method static Builder|EmpContract whereDeletedBy($value)
 * @method static Builder|EmpContract whereDescription($value)
 * @method static Builder|EmpContract whereEmpContractAmountTypeId($value)
 * @method static Builder|EmpContract whereEndDate($value)
 * @method static Builder|EmpContract whereId($value)
 * @method static Builder|EmpContract whereIsActive($value)
 * @method static Builder|EmpContract whereIsVisible($value)
 * @method static Builder|EmpContract whereName($value)
 * @method static Builder|EmpContract whereStartDate($value)
 * @method static Builder|EmpContract whereStatus($value)
 * @method static Builder|EmpContract whereUpdatedAt($value)
 * @method static Builder|EmpContract whereUpdatedBy($value)
 * @method static Builder|EmpContract whereUserEmployeeId($value)
 * @mixin Eloquent
 */
class EmpContract extends Model
{

}