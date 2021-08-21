<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\EmpBankDetail
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $bank_name
 * @property string|null $description
 * @property string|null $account_number
 * @property string|null $IFSC_code
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|EmpBankDetail newModelQuery()
 * @method static Builder|EmpBankDetail newQuery()
 * @method static Builder|EmpBankDetail query()
 * @method static Builder|EmpBankDetail whereAccountNumber($value)
 * @method static Builder|EmpBankDetail whereBankName($value)
 * @method static Builder|EmpBankDetail whereCreatedAt($value)
 * @method static Builder|EmpBankDetail whereCreatedBy($value)
 * @method static Builder|EmpBankDetail whereDeletedAt($value)
 * @method static Builder|EmpBankDetail whereDeletedBy($value)
 * @method static Builder|EmpBankDetail whereDescription($value)
 * @method static Builder|EmpBankDetail whereIFSCCode($value)
 * @method static Builder|EmpBankDetail whereId($value)
 * @method static Builder|EmpBankDetail whereIsActive($value)
 * @method static Builder|EmpBankDetail whereIsVisible($value)
 * @method static Builder|EmpBankDetail whereUpdatedAt($value)
 * @method static Builder|EmpBankDetail whereUpdatedBy($value)
 * @method static Builder|EmpBankDetail whereUserId($value)
 * @mixin Eloquent
 */
class EmpBankDetail extends Model
{

}
