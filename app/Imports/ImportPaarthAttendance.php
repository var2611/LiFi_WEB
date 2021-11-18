<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class ImportPaarthAttendance implements ToCollection, WithMapping
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        //
    }

    public function headingRow(): int
    {
        return 3;
    }

    public function map($row): array
    {
        // TODO: Implement map() method.
        return [
            [
                $row->Days
            ]
        ];
    }
}
