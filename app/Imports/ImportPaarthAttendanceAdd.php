<?php

namespace App\Imports;

use App\Models\Attendance;
use App\Models\User;
use App\Models\UserEmployee;
use Exception;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Row;

class ImportPaarthAttendanceAdd implements OnEachRow, WithEvents
{
    use RegistersEventListeners;

    /**
     * @var int
     */
    private static $total_row_count;
    private $previous_user_index = 0;

    private $month;
    private $year;
    private $days_in_month;
    private $day_data = array();
    private $user_data = array();
    private $userDB;
    private $j = 0;

    public function __construct(string $month, string $year)
    {
        $this->month = $month;
        $this->year = $year;
        $this->days_in_month = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
        $this->userDB = User::get(['id', 'name', 'last_name', 'adhar_number'])->toArray();
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

//            try {
            $i = 0;
            $attendances = array();
            foreach ($this->day_data as $days) {

                foreach ($days as $day) {


                    if ((isset($day['in_time']) && $day['in_time'] > 0) || (isset($day['out_time']) && $day['out_time'] > 0)) {

                        $in_time = $day['in_time'] > 0 ? getDateTimeFromStringAsFormat("Y-m-d H.i", getDBDateAndTimeFormat(), $day['date'] . ' ' . format_number($day['in_time'], 2)) : null;

                        if (!empty($day['out_time']))
                            $out_time = $day['out_time'] > 0 ? getDateTimeFromStringAsFormat("Y-m-d H.i", getDBDateAndTimeFormat(), $day['date'] . ' ' . format_number($day['out_time'], 2)) : null;

                        $attendances[$i]['user_id'] = $day['user_id'];
                        $attendances[$i]['name'] = $day['name'];
                        $attendances[$i]['flash_code'] = '0';
                        $attendances[$i]['date'] = $day['date'];
                        $attendances[$i]['in_time'] = $in_time;
                        $attendances[$i]['out_time'] = $out_time ?? null;

                        if ($day['in_time'] > 0 && $day['out_time'] > 0) {
                            $hours_worked = (strtotime($attendances[$i]['out_time']) - strtotime($attendances[$i]['in_time'])) / 3600;
                        } else {
                            $hours_worked = 0;
                        }

                        $attendances[$i]['hours_worked'] = ($hours_worked ?? 0);

                        $attendances[$i]['status'] = 1;
                        $attendances[$i]['created_by'] = Auth::user()->id;
                        $attendances[$i]['updated_by'] = Auth::user()->id;
                        $i++;
                    }
                }
            }

            echo Attendance::upsert($attendances, ['user_id', 'date'], ['name', 'in_time', 'out_time', 'hours_worked', 'status', 'updated_by']);

//            echo json_encode(count($attendances)) . '<br>';
//            echo json_encode($this->day_data) . '<br>';
//            echo json_encode($attendances) . '<br>';
//            echo json_encode($i);
//            } catch (\Exception $ex) {
//                echo $ex->getMessage() . '<br>';
//                echo json_encode($days);
//            }

        }

        if (((string)$rowIndex)[-1] == 5) {
            $data['department'] = $row[0];
            $data['emp_code'] = $row[2];
            $data['name'] = $row[6];
            $data['card_number'] = $row[8];
//            $data['total_present'] = $row[10];
//            $data['week_off'] = $row[11];
//            $data['holiday'] = $row[12];
//            $data['absent'] = $row[13];
//            $data['paid_leave'] = $row[15];
//            $data['unpaid_leave'] = $row[17];
//            $data['total_leave'] = $row[19];
//            $data['paid_days'] = $row[21];
//            $data['late_hours'] = $row[23];
//            $data['early_hours'] = $row[25];
//            $data['working_hours'] = $row[27];
//            $data['over_time'] = $row[29];

//            echo json_encode($data);
            if (!empty($data['emp_code'])) {
//                $user = att_register_user_with_adhar($data['emp_code'], "New User");

                $adhar_number = $data['emp_code'];
                $this->user_data['adhar_number'] = $adhar_number;

                $search_data = array_search($adhar_number, array_column($this->userDB, 'adhar_number'));

                $this->user_data['user_id'] = $this->userDB[$search_data]['id'];
                $this->user_data['name'] = $this->userDB[$search_data]['name'] . ' ' . $this->userDB[$search_data]['last_name'];

                $this->previous_user_index = $rowIndex;
            }
        }


        try {
            if ($this->previous_user_index > 0) {

                if (($rowIndex - $this->previous_user_index) == 2 /*&& strtolower($row[0]) == 'arr time'*/) {
                    for ($i = 1; $i <= $this->days_in_month; $i++) {
                        $this->day_data[$this->j][$i]['in_time'] = $row[$i];
                        $this->day_data[$this->j][$i]['date'] = "$this->year-$this->month-$i";
                    }
                }
                if (($rowIndex - $this->previous_user_index) == 3 /*&& strtolower($row[0]) == 'dep time'*/) {
                    for ($i = 1; $i <= $this->days_in_month; $i++) {
                        $this->day_data[$this->j][$i]['out_time'] = $row[$i];
                    }
                }
                if (($rowIndex - $this->previous_user_index) == 4 /*&& strtolower($row[0]) == 'working hrs'*/) {
                    for ($i = 1; $i <= $this->days_in_month; $i++) {
                        $this->day_data[$this->j][$i]['hours_worked'] = $row[$i];
                    }
                }
                if (($rowIndex - $this->previous_user_index) == 5 /*&& strtolower($row[0]) == 'over time'*/) {
                    for ($i = 1; $i <= $this->days_in_month; $i++) {
                        $this->day_data[$this->j][$i]['over_time'] = $row[$i];
                    }
                }
                if (($rowIndex - $this->previous_user_index) == 6 /*&& strtolower($row[0]) == 'absent'*/) {
                    for ($i = 1; $i <= $this->days_in_month; $i++) {
                        $this->day_data[$this->j][$i]['absent'] = $row[$i];
                    }
                }
                if (($rowIndex - $this->previous_user_index) == 7 /*&& strtolower($row[0]) == 'break'*/) {
                    for ($i = 1; $i <= $this->days_in_month; $i++) {
                        $this->day_data[$this->j][$i]['break'] = $row[$i];
                    }
                }
                if (($rowIndex - $this->previous_user_index) == 8 /*&& strtolower($row[0]) == 'status'*/) {
                    for ($i = 1; $i <= $this->days_in_month; $i++) {
                        $this->day_data[$this->j][$i]['status'] = $row[$i];
                        $this->day_data[$this->j][$i]['emp_code'] = $this->user_data['adhar_number'];
                        $this->day_data[$this->j][$i]['user_id'] = $this->user_data['user_id'];
                        $this->day_data[$this->j][$i]['name'] = $this->user_data['name'];
                    }

                    $this->user_data = null;
                    $this->previous_user_index = 0;
                    $this->j++;
                }
            }
        } catch (Exception $exception) {
            echo $exception->getMessage() . '<br>';
            echo json_encode($this->user_data);
            echo json_encode($this->previous_user_index);
        }


    }
}
