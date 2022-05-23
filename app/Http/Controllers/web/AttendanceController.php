<?php


namespace App\Http\Controllers\web;


use App\Http\Controllers\Controller;
use App\Http\Livewire\DetailAttendanceView;
use App\Http\Livewire\ListAttendanceEmployeesView;
use App\Http\Livewire\ListAttendanceMyView;
use App\Models\Attendance;
use App\Models\AttendanceData;
use App\Models\Company;
use App\Models\FormModels\DataSalarySlip;
use App\Models\Salary;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Database\Query\Builder;
use LaravelViews\LaravelViews;

class AttendanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index()
    {

    }

    public function listEmpAttendances(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, ListAttendanceEmployeesView::class, 'Employees Attendance', 'att', null, true);
    }

    public function listMyAttendances(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, ListAttendanceMyView::class, 'My Attendance', 'att');
    }

    public function view_att_detail(string $id): string
    {
        $result = AttendanceData::whereId($id)
            ->first();
//        $la = new AttendanceDetailView($id);
        return view('main_detail', ['class' => DetailAttendanceView::getName(), 'model' => $result, 'att' => true])->render();
    }

    public function attendanceExportData(int $month, int $year, string $companyId)
    {
        $holidays = getHolidayDateOfCompanyByMonth($companyId, $month, $year);

        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $sundays = getSundays($month, $year, $daysInMonth, "d");
        $monthly_off = array_unique(array_merge($holidays, $sundays));
        $working_days = $daysInMonth - count($sundays);

        $monthName = getMonthNameFromMonthNumber($month);

        $companyData = Company::whereId($companyId)->first();

        $attendanceData = User::select(['users.id', 'users.name'])
            ->with(['UserEmployee:id,user_id,company_id,emp_code']);
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $attendanceData = $attendanceData->selectSub($this->getDateAttQuery($year, $month, $i), "att_".$i);
        }
        $attendanceData = $attendanceData->whereHas('UserEmployee', function ($q) use ($companyId) {
            $q->where('company_id', '=', $companyId);
        });

        $attendanceData = $attendanceData->take(2)->get();

//        echo json_encode($attendanceData) . '<br>';
//        dd($attendanceData);

//        $la = new AttendanceDetailView($id);
        return [
            'data_attendance_slip' => $attendanceData,
            'daysInMonth' => $daysInMonth,
            'sundays' => $sundays,
            'holidays' => $holidays,
            'companyData' => $companyData,
            'monthName' => $monthName,
            'month' => $month,
            'year' => $year
        ];
        return view('hrms.component.export.attendance-slip',
            [
                'data_attendance_slip' => $attendanceData,
                'daysInMonth' => $daysInMonth,
                'sundays' => $sundays,
                'holidays' => $holidays,
                'companyData' => $companyData,
                'monthName' => $monthName,
                'month' => $month,
                'year' => $year
            ])->render();
    }

    function getDateAttQuery($year, $month, $day)
    {
        return Attendance::select(DB::raw('JSON_ARRAY(in_time, out_time, hours_worked)'))
            ->whereDate('date', $year . "-" . $month . "-" . $day)
            ->whereRaw('attendances.user_id = users.id')
            ->take(1);
    }

}
