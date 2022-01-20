<?php

use App\Http\Controllers\Controller;
use App\Models\AttBreak;
use App\Models\Attendance;
use App\Models\Device;
use App\Models\EmpContract;
use App\Models\EmpContractType;
use App\Models\EmpDepartmentData;
use App\Models\EmpDepartmentType;
use App\Models\EmpPfDetail;
use App\Models\EmpShiftData;
use App\Models\EmpWorkShift;
use App\Models\Holiday;
use App\Models\LeaveType;
use App\Models\Salary;
use App\Models\User;
use App\Models\UserEmployee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use Nette\Utils\DateTime;
use PhpOffice\PhpSpreadsheet\Shared\Date;

/**
 * @return string[]
 */
function getMonthListArray(): array
{
    return [
        '01' => 'January',
        '02' => 'February',
        '03' => 'March',
        '04' => 'April',
        '05' => 'May',
        '06' => 'June',
        '07' => 'July',
        '08' => 'August',
        '09' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December'
    ];
}

/**
 * @return string[]
 */
function getYearListArray(): array
{
    return ['2021' => '2021', '2022' => '2022'];
}

function sendSMS($mobile, $message)
{
    # code...
    echo "1";
    print_r($mobile);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.msg91.com/api/v2/sendsms",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{ \"sender\": \"NVTECH\", \"route\": \"4\", \"country\": \"91\", \"sms\":
    [ { \"message\": \"$message\", \"to\": [ \"$mobile\"] }]}",
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTPHEADER => array(
            "authkey: 322008AkMnr19Q75e63638eP1",
            "content-type: application/json"
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    print_r($response);
    print_r($err);
    curl_close($curl);
    return $response;
//    if ($err) {
//        print_r($err);
//    } else {
//showResultFailed();
//    }
}

/**
 * @param User $user
 * @return string
 */
function create_user_auth_token(User $user): string
{
    return $user->createToken('MyApp')->accessToken;

}

function create_new_device(User $user, string $name, string $mac_address, int $device_type_id)
{
    $input = array();
    $input['name'] = $name;
    $input['device_type_id'] = $device_type_id;
    $input['mac_address'] = $mac_address;
    $input['user_id'] = $user->id;
    $input['created_by'] = Auth::user()->id;
    $input['updated_by'] = Auth::user()->id;
    return Device::create($input);
}

/**
 * @param int $length
 * @return string
 */
function generate_random_unique_string(int $length = 6): string
{
    $randomString = generate_random_string($length);
    $user_employee = UserEmployee::whereFlashCode($randomString)->first();
    if (empty($user_employee)) {
        return $randomString;
    } else {
        generate_random_unique_string($length);
    }
}

function generate_random_string(int $length = 6): string
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function att_register_user(string $mobile, string $name): ?User
{
    try {
        $input['mobile'] = $mobile;
        $input['name'] = $name;
        $checkUserExist = User::whereMobile($input['mobile'])->first();
        if (empty($checkUserExist)) {
            $input['password'] = bcrypt('1234');
            $user = User::create($input);
            if (!empty($user)) {
                return $user;
            }
        }

    } catch (Exception $exception) {
        return null;
    }
    return null;
}

function att_register_user_with_adhar(string $adhar_number, string $name): ?User
{
    try {
        $input['adhar_number'] = $adhar_number;
        $input['name'] = $name;
        $checkUserExist = User::whereAdharNumber($input['adhar_number'])->first();
        if (empty($checkUserExist)) {
            $input['password'] = bcrypt('1234');
            $user = User::create($input);
            if (!empty($user)) {
                return $user;
            }
        } else {
            return $checkUserExist;
        }

    } catch (Exception $exception) {
        return null;
    }
    return null;
}

function att_register_new_employee($data, User $user): ?UserEmployee
{
    $name = $data->name;
    $user_id = $user->id ?? null;
    $last_name = $data->last_name ?? '';
    $middle_name = $data->middle_name ?? '';
    $emp_code = $data->emp_code;
    $firebase_token = $data->firebase_token ?? null;
    $company_id = $data->company_id ?? Auth::user()->getCompanyId() ?? 1;

    if ($user_id) {

        $user->name = $name;
        $user->middle_name = $middle_name;
        $user->last_name = $last_name;
        if ($firebase_token) {
            $user->firebase_token = $firebase_token;
        }
        $user->updated_by = Auth::user()->id;
        $user->save();
        $userEmployee = UserEmployee::whereUserId($user_id)->first();
        if (empty($userEmployee)) {
            $userEmployee = new UserEmployee();
            $userEmployee->user_id = $user_id;
            $userEmployee->user_role_id = 2;
            $userEmployee->company_id = $company_id;
            $userEmployee->emp_code = strtoupper($emp_code);
            $userEmployee->flash_code = generate_random_unique_string();
            $userEmployee->created_by = Auth::user()->id;
        } else {
            $userEmployee->user_id = $user_id;
            $userEmployee->company_id = $company_id;
            $userEmployee->emp_code = strtoupper($emp_code);
        }
        $userEmployee->updated_by = Auth::user()->id;
        $userEmployee->save();
        return $userEmployee;
    }
    return null;
}

function getLeaveTypeIDByName(string $leave_type)
{
    return LeaveType::whereName($leave_type)->first()->id;
}

function getUserNameFromFlashCode($flash_code)
{
    $userEmployee = UserEmployee::whereFlashCode($flash_code)
        ->with(['User'])
        ->first();
    return $userEmployee->User->name;
}

function apiAccessCheck(array $allowed_user_roles): bool
{
    if (Auth::user()->UserApi) {
        return in_array(Auth::user()->UserApi->user_role_id, $allowed_user_roles);
    } else
        return false;
}


/**
 * @return string Date and Time Format Y-m-d H:i:s
 */
function getDBDateAndTimeFormat(): string
{
    return "Y-m-d H:i:s";
}

/**
 * @return string Date Format Y-m-d
 */
function getDBDateFormat(): string
{
    return "Y-m-d";
}

/**
 * @return false|string Current Date
 */
function getTodayDate()
{
    return date(getDBDateFormat());
}

/**
 * @return false|string Yesterday Date Y-m-d
 */
function getYesterdayDate()
{
    return date(getDBDateFormat(), strtotime("-1 days"));
}

/**
 * @return false|string Current Date Time
 */
function getTodayDateTime()
{
    return date(getDBDateAndTimeFormat());
}

function getTodayYearNumber()
{
    return date('Y');
}

function getTodayMonthNumber()
{
    return date('m');
}

function getDateTimeFromStringAsFormat(string $from_format, string $to_format, string $time)
{
//    echo strtotime($time) . '<br>';
    $time = strtotime(date($from_format, strtotime($time)));
    return date($to_format, $time);
}

function getMonthNameFromMonthNumber($month_number): string
{
    return DateTime::createFromFormat('!m', (string)$month_number)->format('F');
}


function getDBDateFrom3FormatString(string $time = null)
{
    if (!$time)
        return null;

    $time = str_replace('/', '-', $time);
    $format_initials = ['/', '.', '-'];
    foreach ($format_initials as $format_initial) {
        //if (strstr($string, $url)) { // mine version
        if (strpos($time, $format_initial) !== FALSE) { // Yoshi version
            $format = 'd' . $format_initial . 'm' . $format_initial . 'Y';
//            echo $format . ' ' . $time . ' ';
            return getDateTimeFromStringAsFormat($format, getDBDateFormat(), $time);
        } else {
//            echo $format_initial . ' ' . $time . ' ';
//            return null;
        }
    }
    return null;
}

function transformDate($value)
{
    if (!$value)
        return null;
    try {
        return getDBDateFrom3FormatString(\date('m-d-Y', strtotime(Carbon::instance(Date::excelToDateTimeObject($value)))));
    } catch (\ErrorException $e) {
        return getDBDateFrom3FormatString($value);
    }
}

function getSundays($month, $year, $days_in_month)
{
    $sundays = array();
    //Create an instance of now
//This is used to determine the current month and also to calculate the first and last day of the month
    $now = new DateTime("$year-$month-01");

//Create a DateTime representation of the first day of the current month based off of "now"
    $start = new DateTime($now->format("$month/01/$year"));

//Create a DateTime representation of the last day of the current month based off of "now"
    $end = new DateTime($now->format("$month/$days_in_month/$year 23:59:59"));

//Define our interval (1 Day)
    $interval = new DateInterval('P1D');

//Setup a DatePeriod instance to iterate between the start and end date by the interval
    $period = new DatePeriod($start, $interval, $end);

//Iterate over the DatePeriod instance
    foreach ($period as $date) {
        if ($date->format('w') == 0) {
            array_push($sundays, $date->format(getDBDateFormat()) . PHP_EOL);
        }
    }

    return $sundays;
}

/**
 * @param Salary $model
 * @return array
 */
function getMonthlyOffDatesByCompany(Salary $model): array
{
    $month = $model->month;
    $year = $model->year;
    $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $sundays = getSundays($month, $year, $days_in_month);
    $holidays = getHolidayDateOfCompanyByMonth(\Auth::user()->getCompanyId(), $month, $year);
    return array_unique(array_merge($holidays, $sundays));
}

function format_number($number, $dec = 0, $trim = false)
{
    if ($trim) {
        $parts = explode(".", (round($number, $dec) * 1));
        $dec = isset($parts[1]) ? strlen($parts[1]) : 0;
    }
    return number_format($number, $dec);
}

function checkOutMissingEntry()
{
    $todayDate = getTodayDate();
    $todayDateTime = getTodayDateTime();
    $attendances = Attendance::join('att_breaks as ab', 'attendances.id', '=', 'ab.attendance_id')
        ->join('user_employees as ue', 'attendances.user_id', '=', 'ue.user_id')
        ->whereRaw("attendances.updated_at = ab.updated_at")
//        ->where('ue.company_id', 2)
//        ->where('attendances.user_id', 1)
//        ->where('attendances.id', 255)
        ->where('attendances.date', '!=', $todayDate)
//        ->where('ab.break_time', '>', 1)
        ->whereNull('attendances.out_time')

//        ->toSql();
//        ->with(['AttBreak'])
        ->get([
            'attendances.id',
            'attendances.user_id',
            'attendances.name',
            'attendances.flash_code',
            'attendances.date',
            'attendances.in_time',
            'attendances.out_time',
            'attendances.hours_worked',
            'attendances.break_time',
            'attendances.difference',
            'attendances.status',
            'attendances.is_active',
            'attendances.is_visible',
            'attendances.created_by',
            'attendances.updated_by',
            'attendances.deleted_by',
            'attendances.created_at',
            'attendances.updated_at',
            'attendances.deleted_at',
        ]);
    if (!empty($attendances) && count($attendances) > 0) {
        /* @var $attendance Attendance */
        foreach ($attendances as $attendance) {
            $attBreak = AttBreak::whereAttendanceId($attendance->id)->whereUpdatedAt($attendance->updated_at)->first();
            if (!empty($attBreak)) {
                $attBreak->deleted_at = $todayDateTime;
                $attBreak->deleted_by = 1;
                $attBreak->save();
                $attendance->out_time = $attBreak->break_out_time;
                $hours_worked = (strtotime($attendance->out_time) - strtotime($attendance->in_time)) / 3600;
                $attendance->hours_worked = $hours_worked;
                $attendance->break_time = $attendance->break_time ? ($attendance->break_time - $attBreak->break_time) : 0;
                $attendance->updated_by = 1;
                $attendance->save();
            }
        }
    }
}

function getUserFullName(int $id): string
{
    $user = User::whereId($id)->first();
    return $user->name . ' ' . ($user->middle_name ? $user->middle_name . ' ' : '') . $user->last_name;
}

/**
 * @return Builder[]|Collection
 */
function getUserList()
{
    $user = Auth::user();
    $company_id = UserEmployee::whereUserId($user->id)->first()->company_id;
    $data = User::with(['UserEmployee']);
    if ($company_id != 1) {
        $data->whereHas('UserEmployee', function ($q) use ($company_id) {
            $q->where('company_id', '=', $company_id);
        });
    }
    return $data->get();
}

function edit_emp_contract($data)
{

    $id = $data['id'];
    $description = $data['description'];
    $date = $data['date'];
    $emp_work_shift_data_id = $data['emp_work_shift_data_id'];
    $emp_contract_type_id = $data['emp_contract_type_id'];
    $emp_contract_status_id = $data['emp_contract_status_id'];
    $amount = $data['amount'];
    $is_active = $data['is_active'];
    $is_visible = $data['is_visible'];
    $user_id = $data['user_id'];
    $attribute = null;
    $empContract = null;
    if ($data['id'] == null) {
        $data['created_by'] = Auth::id();
    } else {
        $attribute['id'] = $id;
    }
    $data['updated_by'] = Auth::id();
    $empContractType = EmpContractType::whereId($emp_contract_type_id)->first();
    $empWorkShift = EmpWorkShift::whereId($emp_work_shift_data_id)->first();
    $userEmployee = UserEmployee::whereUserId($user_id)->with(['User'])->first();
    if ($id) {
        $empContract = EmpContract::whereId($id)->first();
        $empContract->emp_contract_status_id = $emp_contract_status_id;
        $empContract->updated_by = Auth::id();
        $empContract->save();

    } else {
        $userName = getUserFullName($userEmployee->user_id);
        $emp_shift_data = new EmpShiftData();
        $emp_shift_data->user_id = $userEmployee->user_id;
        $emp_shift_data->name = $userName;
        $emp_shift_data->description = $description;
        $emp_shift_data->start_date = $empContractType->start_date;
        $emp_shift_data->end_date = $empContractType->end_date;
        $emp_shift_data->days = $empContractType->days;
        $emp_shift_data->emp_work_shift_id = $empWorkShift->id;
        $emp_shift_data->start_time = $empWorkShift->start_time;
        $emp_shift_data->end_time = $empWorkShift->end_time;
        $emp_shift_data->hours = $empWorkShift->hours;
        $emp_shift_data->created_by = Auth::id();
        $emp_shift_data->updated_by = Auth::id();
        $emp_shift_data->save();
        if ($emp_shift_data) {
            $empContract = new EmpContract();
            $empContract->user_id = $userEmployee->user_id;
            $empContract->name = $userName;
            $empContract->description = $description;
            $empContract->date = $date;
            $empContract->start_date = $empContractType->start_date;
            $empContract->end_date = $empContractType->end_date;
            $empContract->start_time = $emp_shift_data->start_time;
            $empContract->end_time = $emp_shift_data->end_time;
            $empContract->hours = $emp_shift_data->hours;
            $empContract->days = $empContractType->days;
            $empContract->emp_contract_type_id = $empContractType->id;
            $empContract->emp_contract_status_id = $emp_contract_status_id;
            $empContract->salary_total = $empContractType->salary_total > 0 ? $empContractType->salary_total : $amount;
            $empContract->emp_shift_data_id = $emp_shift_data->id;
            $empContract->is_active = $is_active;
            $empContract->is_visible = $is_visible;
            $empContract->created_by = Auth::id();
            $empContract->updated_by = Auth::id();
            $empContract->save();
        }
    }
    return $empContract;
}

/**
 * @param $file
 * @return string
 */
function get_file_extension(UploadedFile $file): string
{
    return $file->getClientOriginalExtension();
}

function upload_file($upload_path, $file_name, $file, string $urlRoot = "https://lifi.navtechno.in"): string
{

    if (!file_exists(public_path() . $upload_path)) {
        if (File::makeDirectory(public_path() . $upload_path, 0777, true)) {
        }
    }

    $path = public_path() . $upload_path;
    $file->move($path, $file_name);
    return $urlRoot . $upload_path . $file_name;
}

/**
 * Mass (bulk) insert or update on duplicate for Laravel 4/5
 *
 * insertOrUpdate([
 *   ['id'=>1,'value'=>10],
 *   ['id'=>2,'value'=>60]
 * ]);
 *
 *
 * @param array $rows
 */
function insertOrUpdate($table, array $rows): bool
{
    $first = reset($rows);

    $columns = implode(',',
        array_map(function ($value) {
            return "$value";
        }, array_keys($first))
    );

    $values = implode(',', array_map(function ($row) {
            return '(' . implode(',',
                    array_map(function ($value) {
                        return '"' . str_replace('"', '""', $value) . '"';
                    }, $row)
                ) . ')';
        }, $rows)
    );

    $updates = implode(',',
        array_map(function ($value) {
            return "$value = VALUES($value)";
        }, array_keys($first))
    );

    $sql = "INSERT INTO {$table}({$columns}) VALUES {$values} ON DUPLICATE KEY UPDATE {$updates}";

    return DB::statement($sql);
}

function import_create_user_batch_data(array $data /*Name and Adhar Number Required*/): array
{
    $batch_user_data['adhar_number'] = $data['emp_code'];
    $batch_user_data['name'] = explode(" ", $data['name'])[0];
    $batch_user_data['last_name'] = explode(" ", $data['name'])[1] ?? null;
    $batch_user_data['middle_name'] = explode(" ", $data['name'])[2] ?? null;
    $batch_user_data['password'] = bcrypt('1234');
    $batch_user_data['created_by'] = Auth::user()->id;
    $batch_user_data['updated_by'] = Auth::user()->id;
    return $batch_user_data;
}

function import_create_user_employee_batch_data($batch_user_data, $company_id): array
{
    $i = 0;
    $j = 0;
    $batch_user_emp_data = array();
    $userDB = User::whereNotNull('adhar_number')->get(['id', 'adhar_number'])->toArray();

    foreach ($batch_user_data as $user) {
        try {
            $adhar_number = $user['adhar_number'];
            $user_id = array_search($adhar_number, array_column($userDB, 'adhar_number'));
            $user_employee = null;

            if ($user_id !== false) {
                $user_employee = UserEmployee::whereEmpCode($adhar_number)->whereUserId($userDB[$user_id]['id'])->first();
            }
            if (!empty($user_employee)) {
//                echo 'Skipped User Emp Code : ' . $adhar_number . ' User ID : ' . $user_id . '<br>';
                $j++;
                continue;
            }

            $batch_user_emp_data[$i]['user_id'] = $userDB[$user_id]['id'] ?? 0;
            $batch_user_emp_data[$i]['user_role_id'] = 2;
            $batch_user_emp_data[$i]['company_id'] = $company_id;
            $batch_user_emp_data[$i]['emp_code'] = $user['adhar_number'];
            $batch_user_emp_data[$i]['flash_code'] = '0';
            $batch_user_emp_data[$i]['created_by'] = Auth::user()->id;
            $batch_user_emp_data[$i]['updated_by'] = Auth::user()->id;
            $i++;
        } catch (\Exception $e) {
            echo $e->getMessage();
            echo 'Error in below User Data :  <br>';
            echo json_encode($user) . '<br>';
            echo 'User ID :' . $user_id . '<br>';
//            break;
        }

    }

    echo 'Already Registered UserEmployee : ' . $j . '<br>';

    return $batch_user_emp_data;
}

function import_employee_hr_data($data): array
{
    $batch_employee_hr_data['adhar_number'] = $data['emp_code'];
    $batch_employee_hr_data['emp_code'] = $data['emp_code'];
    $batch_employee_hr_data['department'] = $data['department'];
    $batch_employee_hr_data['description'] = $data['category'];
    $batch_employee_hr_data['basic_salary'] = $data['basic_salary'];
    $batch_employee_hr_data['salary_hra'] = $data['hra'];
    $batch_employee_hr_data['date_of_join'] = $data['date_of_join'];
    $batch_employee_hr_data['uan'] = $data['uan'];
    $batch_employee_hr_data['pf_number'] = $data['pf_number'];

    return $batch_employee_hr_data;
}

function import_emp_contract_pf_department_batch_entry($employee_contract_data, $company_id)
{


    $other_contract = EmpContractType::whereName('Other')->whereCompanyId($company_id)->first(['id']);

    $userDB = User::whereNotNull('adhar_number')->get(['id', 'name', 'middle_name', 'last_name', 'adhar_number'])->toArray();
    $department_types = EmpDepartmentType::whereNotNull('name')->get(['id', 'name'])->toArray();

    $i = 0;
    $j = 0;

    $batch_employee_contract_data = array();
    $batch_employee_department_data = array();
    $batch_employee_pf_data = array();
    $user_not_found = array();

    try {
        foreach ($employee_contract_data as $employee_contract) {
            $searched_user = array_search($employee_contract['adhar_number'], array_column($userDB, 'adhar_number'));
            $searched_department_type = array_search(trim(strtolower($employee_contract['department'])), array_column($department_types, 'name'));

            $logged_in_user_id = Auth::id();

            if ($searched_user !== false) {
                $user_id = $userDB[$searched_user]['id'];
                $user_name = $userDB[$searched_user]['name'] . ' ' . $userDB[$searched_user]['last_name'];

                if ($searched_department_type !== false) {
                    $department_type_id = $department_types[$searched_department_type]['id'];
                } else {
                    $department_type_id = 2;
                }
                $description = $employee_contract['description'];

                $batch_employee_contract_data[$i]['user_id'] = $user_id;
                $batch_employee_contract_data[$i]['name'] = $user_name;
                $batch_employee_contract_data[$i]['date'] = getTodayDate();
                $batch_employee_contract_data[$i]['start_date'] = getDBDateFrom3FormatString($employee_contract['date_of_join']);
                $batch_employee_contract_data[$i]['emp_contract_type_id'] = $other_contract->id;
                $batch_employee_contract_data[$i]['emp_contract_status_id'] = 1;
                $batch_employee_contract_data[$i]['hours'] = 8;
                $batch_employee_contract_data[$i]['days'] = 364;
                $batch_employee_contract_data[$i]['salary_basic'] = $employee_contract['basic_salary'] ?? 0;
                $batch_employee_contract_data[$i]['salary_hra'] = $employee_contract['salary_hra'] ?? 0;
                $batch_employee_contract_data[$i]['salary_total'] = ($employee_contract['basic_salary'] ?? 0) + ($employee_contract['salary_hra'] ?? 0);
                $batch_employee_contract_data[$i]['created_by'] = $logged_in_user_id;
                $batch_employee_contract_data[$i]['updated_by'] = $logged_in_user_id;

                $batch_employee_department_data[$i]['description'] = $description;
                $batch_employee_department_data[$i]['user_id'] = $user_id;
                $batch_employee_department_data[$i]['emp_department_type_id'] = $department_type_id;
                $batch_employee_department_data[$i]['description'] = $description;
                $batch_employee_department_data[$i]['created_by'] = $logged_in_user_id;
                $batch_employee_department_data[$i]['updated_by'] = $logged_in_user_id;

                if ($employee_contract['pf_number'] && $employee_contract['uan']) {
                    $batch_employee_pf_data[$j]['user_id'] = $user_id;
                    $batch_employee_pf_data[$j]['pf_number'] = $employee_contract['pf_number'];
                    $batch_employee_pf_data[$j]['uan'] = $employee_contract['uan'];
                    $batch_employee_pf_data[$j]['status'] = 1;
                    $batch_employee_pf_data[$j]['created_by'] = $logged_in_user_id;
                    $batch_employee_pf_data[$j]['updated_by'] = $logged_in_user_id;

                    $j++;
                }

                $i++;
            } else {
                $user_not_found[] = $employee_contract;
            }
        }

        echo 'Employee Department Created/Updated : ' . EmpDepartmentData::upsert($batch_employee_department_data, ['user_id', 'emp_department_type_id'], ['description', 'updated_by']) . '<br>';

        echo 'Employee PF Details Created/Updated : ' . EmpPfDetail::upsert($batch_employee_pf_data, ['user_id', 'start_date'], ['bank_name', 'description', 'status', 'updated_by']) . '<br>';

        echo 'Employee Contract Created/Updated : ' . EmpContract::upsert($batch_employee_contract_data, ['user_id', 'start_date'], ['name', 'description', 'date', 'end_date', 'start_time', 'hours', 'days', 'emp_contract_type_id', 'emp_contract_status_id', 'salary_basic', 'salary_hra', 'salary_total', 'emp_shift_data_id', 'updated_by']) . '<br>';

        echo 'Not Found User in DataBase : ' . json_encode($user_not_found) . '<br>';
    } catch (\Exception $ex) {
        echo $ex . '<br>';
        echo $i . '<br>';
        echo json_encode($employee_contract) . '<br>';
        echo json_encode($searched_user) . '<br>';
    }

}

function getFormattedAmountCurrency($amount, $currency_locale = 'en_IN')
{
    return NumberFormatter::create($currency_locale, NumberFormatter::CURRENCY)->format($amount);
}

function getNumberToWord($amount, $locale = 'en_IN')
{
    $f = new NumberFormatter($locale, NumberFormatter::SPELLOUT);
    return $f->format($amount);
}

function getHolidayDateOfCompanyByMonth(string $company_id, string $month, string $year)
{
    return Holiday::whereCompanyId($company_id)
        ->whereMonth('date', $month)
        ->whereYear('date', $year)
        ->get('date')->pluck('date')->toArray();
}

function validateSalaryGenerate($month, $year, Controller $controller): bool
{
    $is_salary_available = boolval(false);
    $month_fail_message = 'You Have Selected Month ' . getMonthNameFromMonthNumber($month) . ' ' . $year . '. Select Less Than Current one';

    $attendance_fail_message = 'You Have No Attendance In Selected Month ' . getMonthNameFromMonthNumber($month) . ' ' . $year;

    if ($year >= getTodayYearNumber() || $month < getTodayMonthNumber()) {
        $is_salary_available = false;
        $controller->notifyMessage(false, $month_fail_message);
        return $is_salary_available;
    }

    $company_id = Auth::user()->getCompanyId();

    $data = Attendance::with(['User', 'User.UserEmployee'])
        ->whereMonth('date', $month)
        ->whereYear('date', $year)
        ->whereHas('User.UserEmployee', function ($q) use ($company_id) {
            $q->where('company_id', '=', $company_id);
//                $q->where('user_id', '=', 'users.id');
        })->count('id');

    if ($data > 0) {
        $is_salary_available = true;
    } else {
        $is_salary_available = false;
        $controller->notifyMessage(false, $attendance_fail_message);
    }
    return $is_salary_available;

}
