<?php

namespace App\Imports;

use Auth;
use DB;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Row;
use PDO;

class ImportLatLongNonInternetData implements OnEachRow, WithEvents, WithChunkReading
{
    use RegistersEventListeners;

    private static int $total_row_count;

    private int $heading_row_number;
    private int $company_id;
    private int $j = 0;

    private array $batch_non_internet_data;

    public function __construct(string $heading_row_number, string $company_id)
    {
        $this->heading_row_number = $heading_row_number;
        $this->company_id = $company_id;
    }

    public static function beforeImport(BeforeImport $event)
    {
        self::$total_row_count = array_values($event->getDelegate()->getTotalRows())[0];
    }

    public static function afterImport(AfterImport $event)
    {
        $importer_this = $event->getConcernable();

//        it's the same instance.
//        echo DB::connection()->getPdo() === (new \App\Models\ImportLatLongNonInternetData)->getConnection()->getPdo(); // true

// set TRUE;
        DB::connection()->getPdo()->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);

        echo 'Non Internet Lat-Long Data : ' . \App\Models\ImportLatLongNonInternetData::upsert($importer_this->batch_non_internet_data, ['name', 'latitude', 'longitude'], [
                'group_id', 'name', 'latitude', 'longitude', 'block', 'district', 'zone', 'state', 'file_name', 'created_by', 'updated_by'
            ]) . '<br>';

        // set FALSE
        DB::connection()->getPdo()->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray(null, true); //Calculated Formulas
        $data = array();

        if ($rowIndex > $this->heading_row_number /*&& $rowIndex > 5000*/ /*&& $rowIndex < 5*/) {
            $data['group_id'] = $row[0] ?? null;
            $data['name'] = strtolower($row[1]) ?? null;
            $data['latitude'] = floatval($row[2]) ?? null;
            $data['longitude'] = floatval($row[3]) ?? null;
            $data['block'] = strtolower(trim($row[4])) ?? null;
            $data['district'] = strtolower(trim($row[5])) ?? null;
            $data['zone'] = strtolower(trim($row[6])) ?? null;
            $data['state'] = strtolower(trim($row[7])) ?? null;
            $data['file_name'] = strtolower(trim($row[8])) ?? null;
            $data['created_by'] = Auth::user()->id;
            $data['updated_by'] = Auth::user()->id;

            if (!empty($data['latitude']) && !empty($data['longitude']) && !empty($data['name'])) {
                $this->batch_non_internet_data[$this->j] = $data;
                $this->j++;
            }
        }
    }

    public function chunkSize(): int
    {
        return 4000;
    }
}
