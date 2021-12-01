<?php

namespace App\Imports;

use App\Models\User;
use App\Models\UserEmployee;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Row;

class ImportPaarthAttendanceCreateUser implements OnEachRow, WithEvents
{
    use RegistersEventListeners;

    /**
     * @var int
     */
    private static $total_row_count;
    private $previous_user_index = 0;
    private $user = null;
    private $user_employee = null;

    private $month;
    private $year;
    private $company_id;
    private $batch_user_data = array();
    private $j = 0;
    private $userDB;

    public function __construct(string $month, string $year, string $company_id)
    {
        $this->month = $month;
        $this->year = $year;
        $this->company_id = $company_id;
    }

    public static function beforeImport(BeforeImport $event)
    {
        self::$total_row_count = array_values($event->getDelegate()->getTotalRows())[0];
    }

    /**
     * @var UserEmployee|null
     */

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();

        if ($rowIndex == self::$total_row_count) {
//            echo json_encode($this->batch_data);
            echo 'User Created/Updated : ' . User::upsert($this->batch_user_data, ['name', 'adhar_number'], ['name', 'surname', 'updated_by']) . '<br>';

            $batch_user_emp_data = import_create_user_employee_batch_data($this->batch_user_data, $this->company_id);

            echo 'UserEmployee Created/Updated : ' . UserEmployee::upsert($batch_user_emp_data, ['company_id', 'emp_code'], ['user_id', 'user_role_id', 'company_id', 'emp_code', 'flash_code', 'created_by', 'updated_by']) . '<br>';

        }

        if (((string)$rowIndex)[-1] == 5) {
            $data['department'] = $row[0];
            $data['emp_code'] = $row[2];
            $data['name'] = $row[6];
            $data['card_number'] = $row[8];

//            echo json_encode($data);
            if (!empty($data['emp_code'])) {

                $this->batch_user_data[$this->j] = import_create_user_batch_data($data);

                $this->j++;
            }
        }
    }
}
