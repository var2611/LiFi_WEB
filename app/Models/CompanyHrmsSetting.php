<?php


namespace App\Models;


use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\CompanyHrmsSetting
 *
 * @property int $id
 * @property int|null $company_id
 * @property string|null $description
 * @property string|null $pf_percentage
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read Company $Company
 * @method static Builder|CompanyHrmsSetting newModelQuery()
 * @method static Builder|CompanyHrmsSetting newQuery()
 * @method static Builder|CompanyHrmsSetting query()
 * @method static Builder|CompanyHrmsSetting whereCompanyId($value)
 * @method static Builder|CompanyHrmsSetting whereCreatedAt($value)
 * @method static Builder|CompanyHrmsSetting whereCreatedBy($value)
 * @method static Builder|CompanyHrmsSetting whereDeletedAt($value)
 * @method static Builder|CompanyHrmsSetting whereDeletedBy($value)
 * @method static Builder|CompanyHrmsSetting whereDescription($value)
 * @method static Builder|CompanyHrmsSetting whereId($value)
 * @method static Builder|CompanyHrmsSetting whereIsActive($value)
 * @method static Builder|CompanyHrmsSetting whereIsVisible($value)
 * @method static Builder|CompanyHrmsSetting wherePfPercentage($value)
 * @method static Builder|CompanyHrmsSetting whereUpdatedAt($value)
 * @method static Builder|CompanyHrmsSetting whereUpdatedBy($value)
 * @mixin Eloquent
 */
class CompanyHrmsSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'description',
        'pf_percentage',
        'is_active',
        'is_visible',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];

    public function Company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'id');
    }
}
