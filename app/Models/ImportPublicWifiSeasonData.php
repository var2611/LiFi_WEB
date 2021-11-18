<?php


namespace App\Models;


use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ImportPublicWifiSeasonData
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $mobile
 * @property string|null $mobile_with_isd_code
 * @property string|null $isd_code
 * @property string|null $sms_request_country
 * @property string|null $time_spent
 * @property string|null $session_time
 * @property string|null $download_data
 * @property string|null $upload_data
 * @property string|null $total_data
 * @property string|null $user_mac
 * @property string|null $device_type
 * @property string|null $device_model
 * @property string|null $public_ip
 * @property string|null $private_ip
 * @property string|null $login_start_time
 * @property string|null $login_stop_time
 * @property string|null $location_name
 * @method static Builder|ImportPublicWifiSeasonData newModelQuery()
 * @method static Builder|ImportPublicWifiSeasonData newQuery()
 * @method static Builder|ImportPublicWifiSeasonData query()
 * @method static Builder|ImportPublicWifiSeasonData whereDeviceModel($value)
 * @method static Builder|ImportPublicWifiSeasonData whereDeviceType($value)
 * @method static Builder|ImportPublicWifiSeasonData whereDownloadData($value)
 * @method static Builder|ImportPublicWifiSeasonData whereEmail($value)
 * @method static Builder|ImportPublicWifiSeasonData whereId($value)
 * @method static Builder|ImportPublicWifiSeasonData whereIsdCode($value)
 * @method static Builder|ImportPublicWifiSeasonData whereLocationName($value)
 * @method static Builder|ImportPublicWifiSeasonData whereLoginStartTime($value)
 * @method static Builder|ImportPublicWifiSeasonData whereLoginStopTime($value)
 * @method static Builder|ImportPublicWifiSeasonData whereMobile($value)
 * @method static Builder|ImportPublicWifiSeasonData whereMobileWithIsdCode($value)
 * @method static Builder|ImportPublicWifiSeasonData whereName($value)
 * @method static Builder|ImportPublicWifiSeasonData wherePrivateIp($value)
 * @method static Builder|ImportPublicWifiSeasonData wherePublicIp($value)
 * @method static Builder|ImportPublicWifiSeasonData whereSessionTime($value)
 * @method static Builder|ImportPublicWifiSeasonData whereSmsRequestCountry($value)
 * @method static Builder|ImportPublicWifiSeasonData whereTimeSpent($value)
 * @method static Builder|ImportPublicWifiSeasonData whereTotalData($value)
 * @method static Builder|ImportPublicWifiSeasonData whereUploadData($value)
 * @method static Builder|ImportPublicWifiSeasonData whereUserMac($value)
 * @mixin Eloquent
 * @property string|null $converted_session_time
 * @property string|null $converted_total_data
 * @method static Builder|ImportPublicWifiSeasonData whereConvertedSessionTime($value)
 * @method static Builder|ImportPublicWifiSeasonData whereConvertedTotalData($value)
 */
class ImportPublicWifiSeasonData extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'email',
        'mobile',
        'mobile_with_isd_code',
        'isd_code',
        'sms_request_country',
        'time_spent',
        'session_time',
        'download_data',
        'upload_data',
        'total_data',
        'user_mac',
        'device_type',
        'device_model',
        'public_ip',
        'private_ip',
        'login_start_time',
        'login_stop_time',
        'location_name',
    ];


}
