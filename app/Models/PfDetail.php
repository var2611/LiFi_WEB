<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\PfDetail
 *
 * @property int $id
 * @property int $salary_id
 * @property string|null $name
 * @property string|null $pf_wages pf_salary
 * @property string|null $ee_amount
 * @property string|null $er_amount
 * @property string|null $pension_amount
 * @property string|null $ee_total_amount
 * @property string|null $er_total_amount
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|PfDetail newModelQuery()
 * @method static Builder|PfDetail newQuery()
 * @method static Builder|PfDetail query()
 * @method static Builder|PfDetail whereCreatedAt($value)
 * @method static Builder|PfDetail whereCreatedBy($value)
 * @method static Builder|PfDetail whereDeletedAt($value)
 * @method static Builder|PfDetail whereDeletedBy($value)
 * @method static Builder|PfDetail whereEeAmount($value)
 * @method static Builder|PfDetail whereEeTotalAmount($value)
 * @method static Builder|PfDetail whereErAmount($value)
 * @method static Builder|PfDetail whereErTotalAmount($value)
 * @method static Builder|PfDetail whereId($value)
 * @method static Builder|PfDetail whereIsActive($value)
 * @method static Builder|PfDetail whereIsVisible($value)
 * @method static Builder|PfDetail whereName($value)
 * @method static Builder|PfDetail wherePensionAmount($value)
 * @method static Builder|PfDetail wherePfWages($value)
 * @method static Builder|PfDetail whereSalaryId($value)
 * @method static Builder|PfDetail whereUpdatedAt($value)
 * @method static Builder|PfDetail whereUpdatedBy($value)
 * @mixin Eloquent
 */
class PfDetail extends Model
{

}
