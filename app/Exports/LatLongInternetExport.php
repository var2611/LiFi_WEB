<?php

namespace App\Exports;

use App\Models\ImportLatLongInternetData;
use App\Models\ImportLatLongNonInternetData;
use App\Models\salary;
use Auth;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class LatLongInternetExport implements FromQuery, WithMapping, WithColumnFormatting, WithHeadings, ShouldAutoSize
{
    /**
     * @var ImportLatLongNonInternetData $row
     */
    public function map($row): array
    {
        $nearData = ImportLatLongInternetData::select(['*'])
            ->selectSub("(ST_Distance_Sphere(
                ST_GeomFromText(
                        CONCAT('POINT(',
                               CONCAT(import_lat_long_internet_data.longitude, ' ',
                                      import_lat_long_internet_data.latitude), ')'), 4326),
                ST_GeomFromText(
                        CONCAT('POINT(',
                               CONCAT($row->longitude, ' ',
                                      $row->latitude), ')'), 4326)) /
        1000)", 'distance')
            ->orderBy('distance')
            ->first();

        return [
            $row->group_id,//A
            $row->name,//B
            $row->latitude,//C
            $row->longitude,//D
            $row->zone,//E
            $row->state,//F
            $row->file_name,//G
            $row->district,//H
            $nearData->distance,//I
            $nearData->group_id,//J
            $nearData->name,//K
            $nearData->latitude,//L
            $nearData->longitude,//M
            $nearData->state,//N
            $nearData->file_name,//O
        ];
    }

    public function query()
    {
        return ImportLatLongNonInternetData::query();
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => '0.0000',
            'D' => '0.0000',
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_TEXT,
            'G' => NumberFormat::FORMAT_TEXT,
            'H' => NumberFormat::FORMAT_TEXT,
            'I' => NumberFormat::FORMAT_NUMBER_00,
            'J' => NumberFormat::FORMAT_NUMBER,
            'K' => NumberFormat::FORMAT_TEXT,
            'L' => '0.0000',
            'M' => '0.0000',
            'N' => NumberFormat::FORMAT_TEXT,
            'O' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function headings(): array
    {
        return [
            'GROUP_ID', //A
            'NAME',//B
            'LATITUDE',//C
            'LONGITUDE',//D
            'ZONE',//E
            'STATE',//F
            'FILE_NAME',//G
            'DISTRICT',//H
            'DISTANCE',//I
            'GROUP_ID',//J
            'NAME',//K
            'LATITUDE',//L
            'LONGITUDE',//M
            'STATE',//N
            'FILE_NAME',//O
        ];
    }
}
