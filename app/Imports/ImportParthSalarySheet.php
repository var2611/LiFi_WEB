<?php

namespace App\Imports;

use App\Models\ImportPublicWifiSeasonData;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Validators\Failure;

class ImportParthSalarySheet implements ToModel, WithBatchInserts, SkipsOnFailure, SkipsEmptyRows, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {
        return new ImportPublicWifiSeasonData([
            'name' => $row['name_of_the_employee'],
            'UAN' => $row['uan'],
            'mobile' => '',
            'description' => $row['department'],
            'date_of_join' => $row['doj'],
            'date_of_birth' => $row['dob'],
            'gender' => $row['male_female'],
            'department' => $row['department'],
            'category' => $row['category'],
            'minimum_wages' => $row['minimum_wages'],
            'days_total' => $row['tt_wrk_day'],
            'holiday' => $row['holiday'],
            'days_absent' => $row['days_absent'],
            'days_working' => $row['total_working_days'],
            'amount_advance_recovery' => $row['advance_recovery'],
            'amount_room_rent_excess' => $row['room_rentexcess_paid'],
            'salary_gross' => $row['actual_gross'],
            'salary_basic' => $row['basic_da'],
            'salary_hra' => $row['hra'],
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);
    }

    public function headingRow(): int
    {
        return 3;
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function onFailure(Failure ...$failures)
    {
        // TODO: Implement onFailure() method.
    }
}
