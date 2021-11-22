<?php

namespace App\Imports;

use App\Models\Attendance;
use App\Models\FormModels\EmpRegForData;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;

class ImportPaarthAttendance implements OnEachRow
{
    private $previous_user_index = 0;
    private $user = null;
    private $month = 10;
    private $year = 2021;
    private $day_data = array();
    private $user_employee;
    private $batch_data = array();
    private $j = 0;

    /**
     * @var \App\Models\UserEmployee|null
     */


    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();
        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);

//        if (strtolower($row[0]) == 'days') {
//            echo $row[1];
//            echo $rowIndex;
//            exit();
//
//        }


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

                $user_data['adhar_number'] = $data['emp_code'];
                $user_data['name'] = explode(" ", $data['name'])[0];
                $user_data['surname'] = explode(" ", $data['name'])[1] ?? null;
                $user_data['password'] = bcrypt('1234');
//                $user_data['created_at'] = now();
//                $user_data['updated_at'] = now();
                $user_data['created_by'] = Auth::user()->id;
                $user_data['updated_by'] = Auth::user()->id;

                $this->batch_data[$this->j] = $user_data;
                $this->j++;
                if ($rowIndex == 2465) {
//                    echo json_encode($this->batch_data);
//                    echo json_encode(reset($this->batch_data));
                    echo User::upsert($this->batch_data, ['name', 'adhar_number'], ['name', 'surname', 'updated_by']);
                }

                /*if ($user) {
                    $user_data['company_id'] = 4;
                    $user_data['name'] = explode(" ", $data['name'])[0];
                    $user_data['surname'] = explode(" ", $data['name'])[1] ?? null;
                    $user_data['emp_code'] = $data['emp_code'];
                    $empRegistrationData = (new EmpRegForData($user_data))->paarthAttendanceUserdata();

                    $user_employee = att_register_new_employee($empRegistrationData, $user);

                    if (!empty($user) && !empty($user_employee)) {
                        $this->user = $user;
                        $this->user_employee = $user_employee;
                        $this->previous_user_index = $rowIndex;
                    }
                }*/
            }
        }

/*
        try {
            if (!empty($this->user) && !empty($this->user_employee) && $this->previous_user_index > 0) {

                if (($rowIndex - $this->previous_user_index) == 2 && strtolower($row[0]) == 'arr time') {
                    for ($i = 1; $i <= $days_in_month; $i++) {
                        $this->day_data[$i]['in_time'] = $row[$i];
                        $this->day_data[$i]['date'] = "$this->year-$this->month-$i";
                    }
                }
                if (($rowIndex - $this->previous_user_index) == 3 && strtolower($row[0]) == 'dep time') {
                    for ($i = 1; $i <= $days_in_month; $i++) {
                        $this->day_data[$i]['out_time'] = $row[$i];
                    }
                }
                if (($rowIndex - $this->previous_user_index) == 4 && strtolower($row[0]) == 'working hrs') {
                    for ($i = 1; $i <= $days_in_month; $i++) {
                        $this->day_data[$i]['hours_worked'] = $row[$i];
                    }
                }
                if (($rowIndex - $this->previous_user_index) == 5 && strtolower($row[0]) == 'over time') {
                    for ($i = 1; $i <= $days_in_month; $i++) {
                        $this->day_data[$i]['over_time'] = $row[$i];
                    }
                }
                if (($rowIndex - $this->previous_user_index) == 6 && strtolower($row[0]) == 'absent') {
                    for ($i = 1; $i <= $days_in_month; $i++) {
                        $this->day_data[$i]['absent'] = $row[$i];
                    }
                }
                if (($rowIndex - $this->previous_user_index) == 7 && strtolower($row[0]) == 'break') {
                    for ($i = 1; $i <= $days_in_month; $i++) {
                        $this->day_data[$i]['break'] = $row[$i];
                    }
                }
                if (($rowIndex - $this->previous_user_index) == 8 && strtolower($row[0]) == 'status') {
                    for ($i = 1; $i <= $days_in_month; $i++) {
                        $this->day_data[$i]['status'] = $row[$i];
                    }

                    foreach ($this->day_data as $day) {
                        $checkAttendance = Attendance::whereUserId($this->user->id)
                            ->whereDate('date', $day['date'])->first();

                        if ($checkAttendance) {
                            $attendance = $checkAttendance;
                        } else {
                            $attendance = new Attendance();
                            $attendance->created_by = Auth::user()->id;
                        }

                        if ($day['in_time'] > 0 || $day['out_time'] > 0) {

                            $in_time = $day['in_time'] > 0 ? getDateTimeFromStringAsFormat("Y-m-d H.i", "Y-m-d H:i", $day['date'] . ' ' . round($day['in_time'], 2)) : null;

                            $out_time = $day['out_time'] > 0 ? getDateTimeFromStringAsFormat("Y-m-d H.i", "Y-m-d H:i", $day['date'] . ' ' . round($day['out_time'], 2)) : null;

                            $attendance->user_id = $this->user->id;
                            $attendance->name = $this->user->name . ' ' . $this->user->surname;
                            $attendance->flash_code = $this->user_employee->flash_code;
                            $attendance->date = $day['date'];
                            $attendance->in_time = $in_time;
                            $attendance->out_time = $out_time;

                            if ($day['in_time'] > 0 && $day['out_time'] > 0) {
                                $hours_worked = (strtotime($attendance->out_time) - strtotime($attendance->in_time)) / 3600;
                            } else {
                                $hours_worked = 0;
                            }

                            $attendance->hours_worked = ($hours_worked ?? 0);

                            $attendance->status = 1;
                            $attendance->updated_by = Auth::user()->id;
                            $attendance->save();
                        }

                        $this->user = null;
                        $this->day_data = null;
                        $this->user_employee = null;
                        $this->previous_user_index = null;
                    }
                }
            }
        } catch (\Exception $exception) {
            echo $exception->getMessage() . '<br>';
            echo json_encode($this->user);
            echo json_encode($this->previous_user_index);
        }
        */

    }
}
