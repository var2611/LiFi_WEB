<?php


namespace App\Models;


use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


/**
 * App\Models\ImportLifiFreeWifiDataFile
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $url
 * @property string|null $date
 * @property int $is_active
 * @property int $is_visible
 * @property string $created_by
 * @property string $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|ImportLifiFreeWifiDataFile newModelQuery()
 * @method static Builder|ImportLifiFreeWifiDataFile newQuery()
 * @method static Builder|ImportLifiFreeWifiDataFile query()
 * @method static Builder|ImportLifiFreeWifiDataFile whereCreatedAt($value)
 * @method static Builder|ImportLifiFreeWifiDataFile whereCreatedBy($value)
 * @method static Builder|ImportLifiFreeWifiDataFile whereDate($value)
 * @method static Builder|ImportLifiFreeWifiDataFile whereDeletedAt($value)
 * @method static Builder|ImportLifiFreeWifiDataFile whereDeletedBy($value)
 * @method static Builder|ImportLifiFreeWifiDataFile whereId($value)
 * @method static Builder|ImportLifiFreeWifiDataFile whereIsActive($value)
 * @method static Builder|ImportLifiFreeWifiDataFile whereIsVisible($value)
 * @method static Builder|ImportLifiFreeWifiDataFile whereName($value)
 * @method static Builder|ImportLifiFreeWifiDataFile whereUpdatedAt($value)
 * @method static Builder|ImportLifiFreeWifiDataFile whereUpdatedBy($value)
 * @method static Builder|ImportLifiFreeWifiDataFile whereUrl($value)
 * @mixin Eloquent
 */
class ImportLifiFreeWifiDataFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'date',
        'is_active',
        'is_visible',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


}
