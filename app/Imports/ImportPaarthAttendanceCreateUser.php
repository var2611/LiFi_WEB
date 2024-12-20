<?php

namespace App\Imports;

use App\Models\User;
use App\Models\UserEmployee;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Row;

class ImportPaarthAttendanceCreateUser implements OnEachRow, WithEvents, SkipsEmptyRows
//    , WithChunkReading, ShouldQueue, WithEvents
{
    use RegistersEventListeners;

    /**
     * @var int
     */
    private static $total_row_count;
    private $previous_user_index = 0;
    private $user = null;
    private $user_employee = null;

    private $company_id;
    private $season_id;
    private $batch_user_data = array();
    private $j = 0;
    private $userDB;

    public function __construct(string $company_id, $season_id)
    {
        $this->company_id = $company_id;
        $this->season_id = $season_id;
    }

    public static function beforeImport(BeforeImport $event)
    {
        self::$total_row_count = array_values($event->getDelegate()->getTotalRows())[0];

        $totalRows = $event->getReader()->getTotalRows();

        $importer_this = $event->getConcernable();

        if (filled($totalRows)) {
            cache()->forever("total_rows_{$importer_this->season_id}", array_values($totalRows)[0]);
            cache()->forever("start_date_{$importer_this->season_id}", now()->unix());
        }
    }

    public static function afterImport(AfterImport $event)
    {
        /*
           Due to static function can't access $this variable
           $event->getConcernable() will fetch current importer's data
       */
        $importer_this = $event->getConcernable();

//        dd($importer_this->batch_user_data);

        echo 'User Created/Updated : ' . User::upsert($importer_this->batch_user_data, ['name', 'adhar_number'], ['name', 'last_name', 'updated_by']) . '<br>';

        $batch_user_emp_data = import_create_user_employee_batch_data($importer_this->batch_user_data, $importer_this->company_id);

//        dd($batch_user_emp_data);

        echo 'UserEmployee Created/Updated : ' . UserEmployee::upsert($batch_user_emp_data, ['company_id', 'emp_code'], ['user_id', 'user_role_id', 'company_id', 'emp_code', 'flash_code', 'created_by', 'updated_by']) . '<br>';

        cache(["end_date_{$importer_this->season_id}" => now()], now()->addMinute());
        cache()->forget("total_rows_{$importer_this->season_id}");
        cache()->forget("start_date_{$importer_this->season_id}");
        cache()->forget("current_row_{$importer_this->season_id}");
    }

    /**
     * @var UserEmployee|null
     */

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();
        cache()->forever("current_row_{$this->season_id}", $rowIndex);

        if (((string)$rowIndex)[-1] == 5) {
            $data['department'] = $row[0];
            $data['emp_code'] = $row[2];
            $data['name'] = $row[6];
            $data['card_number'] = $row[8];

//            echo json_encode($data);
//            exit();
            if (!empty($data['emp_code'])) {

                $this->batch_user_data[$this->j] = import_create_user_batch_data($data);

                $this->j++;
            }
        }
    }

//    public function chunkSize(): int
//    {
//        return 100;
//    }
}
