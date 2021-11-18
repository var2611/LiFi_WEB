<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Validators\Failure;

class ImportPublicWifiSeasonData implements ToModel, WithHeadingRow, SkipsOnFailure
{

    public function model(array $row)
    {
        return new \App\Models\ImportPublicWifiSeasonData([
            'name' => $row['name'],
            'email' => $row['email'],
            'mobile' => $row['mobile'],
            'full_mobile' => $row['mobileisdcode'],
            'isd_code' => $row['isd_code'],
            'country_name' => $row['country_name'],
            'time_spent' => $row['time_spent'],
            'time_spent_sec' => $row['time_spent_sec'],
            'download_data' => $row['download_data_mb'],
            'upload_data' => $row['upload_data_mb'],
            'total_data' => $row['total_data_mb'],
            'mac_address' => $row['mac_address'],
            'device_type' => $row['device_type'],
            'device_model' => $row['device_model'],
            'public_ip' => $row['public_ip'],
            'private_ip' => $row['private_ip'],
            'login_time' => $row['login_time'],
            'logout_time' => $row['logout_time'],
            'location_name' => $row['location_name'],
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function onFailure(Failure ...$failures)
    {
        // TODO: Implement onFailure() method.
    }
}
