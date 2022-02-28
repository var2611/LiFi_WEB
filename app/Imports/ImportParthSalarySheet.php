<?php

namespace App\Imports;

use App\Models\EmpDepartmentType;
use App\Models\FormModels\DataEmpContract;
use App\Models\User;
use App\Models\UserEmployee;
use Auth;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Row;

class ImportParthSalarySheet implements OnEachRow, WithEvents
//    , WithHeadingRow, WithMappedCells
{
    use RegistersEventListeners;

    private static $total_row_count;
    private $userDB;
    private $heading_row_number;
    private $company_id;

    private $batch_user_data;
    private $employee_hr_data;
    private $j = 0;

    private $batch_department_type_data;
    private DataEmpContract $dataEmpContract;

    public function __construct(string $heading_row_number, string $company_id, DataEmpContract $dataEmpContract)
    {
        $this->heading_row_number = $heading_row_number;
        $this->dataEmpContract = $dataEmpContract;
        $this->company_id = $company_id;
        $this->userDB = User::whereNotNull('adhar_number')->get(['id', 'adhar_number'])->toArray();
    }

    public static function beforeImport(BeforeImport $event)
    {
        self::$total_row_count = array_values($event->getDelegate()->getTotalRows())[0];
    }

    public static function afterImport(AfterImport $event)
    {
        /*
            Due to static function can't access $this variable
            $event->getConcernable() will fetch current importer's data
        */
        $importer_this = $event->getConcernable();

//        dd($importer_this->batch_user_data);

        $upsert_user = User::upsert($importer_this->batch_user_data, ['name', 'adhar_number'], ['name', 'last_name', 'updated_by']);
        echo 'User Created/Updated : ' . $upsert_user . '<br>';

        $batch_user_emp_data = import_create_user_employee_batch_data($importer_this->batch_user_data, $importer_this->company_id);

        echo 'UserEmployee Created/Updated : ' . UserEmployee::upsert($batch_user_emp_data, ['company_id', 'emp_code'], ['user_id', 'user_role_id', 'company_id', 'emp_code', 'gender', 'flash_code', 'created_by', 'updated_by']) . '<br>';

        echo 'Employee Department Type Created/Updated : ' . EmpDepartmentType::upsert($importer_this->batch_department_type_data, ['name'], ['name', 'updated_by']) . '<br>';

        import_emp_contract_pf_department_batch_entry($importer_this->employee_hr_data, $importer_this->company_id, $importer_this->dataEmpContract);
    }

    public function mapping(): array
    {
        return [
            'uan' => 'B33',
            'pf_number' => 'B9',
        ];
    }

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray(null, true); //Calculated Formulas

        if ($rowIndex > $this->heading_row_number) {
//        if ($rowIndex > 155) {
//            $data['department'] = $row[2] ?? null;
//            $data['date_of_join'] = transformDate(intval($row[3]) ?? null);
//            $data['emp_code'] = $row[6];
//            $data['name'] = $row[7];
//            $data['gender'] = null;
//            $data['category'] = $row[8] ?? null;
//            $data['per_day_wages'] = null;
//            $data['basic_salary'] = $row[9];
//            $data['hra'] = $row[10];
//            $data['uan'] = $row[28] ?? null;
//            $data['pf_number'] = $row[27] ?? null;

//            $data['department'] = $row[1] ?? null;
//            $data['date_of_join'] = transformDate($row[4] ?? null);
//            $data['emp_code'] = $row[7];
//            $data['name'] = $row[8];
//            $data['gender'] = $row[9] ?? null;
//            $data['category'] = $row[10] ?? null;
//            $data['per_day_wages'] = $row[14] ?? null;
//            $data['basic_salary'] = $row[16];
//            $data['hra'] = $row[17];
//            $data['uan'] = $row[33] ?? null;
//            $data['pf_number'] = $row[34] ?? null;
//
            $data['department'] = $row[1] ?? null;
            $data['date_of_join'] = transformDate($row[2] ?? null);
            $data['emp_code'] = $row[3];
            $data['name'] = $row[4];
            $data['gender'] = $row[5] ?? null;
            $data['category'] = $row[6] ?? null;
            $data['per_day_wages'] = $row[9] ?? null;
            $data['basic_salary'] = $row[11] ?? null;
            $data['gross_salary'] = $row[13] ?? null;
            $data['hra'] = $row[12] ?? null;
            $data['uan'] = $row[14] ?? null;
            $data['pf_number'] = $row[15] ?? null;
//
////            dd($data);

            if (!empty($data['emp_code'])) {

                $this->batch_user_data[$this->j] = import_create_user_batch_data($data);

                $this->employee_hr_data[$this->j] = import_employee_hr_data($data);

                if (trim($data['department'])) {
                    $this->batch_department_type_data[$this->j]['name'] = trim(strtolower($data['department']));
                    $this->batch_department_type_data[$this->j]['updated_by'] = Auth::id();
                    $this->batch_department_type_data[$this->j]['created_by'] = Auth::id();
                }
                $this->j++;
            }
        }
    }
}
