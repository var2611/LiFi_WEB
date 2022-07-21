<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use LaravelViews\LaravelViews;

class HomeController extends Controller
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


    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('hrms.dashboard');
    }

    public function welcome(Request $request)
    {
        if (Auth::user()->isFreeLiFiWiFi()) {
            return redirect()->route('list-free-lifi-wifi-file');
        }
        return view('hrms.welcome');

    }

    public function demo(LaravelViews $laravelViews)
    {
//        echo bcrypt('gil@wifi#lifi');
//        echo  getTodayDateTime();

//        $employee_contract['abry_eligible'] = '-11';
//        echo getMonthFromDisplayFormat("11-26-1196");
//        echo getYearFromDisplayFormat("11-26-1996");

//        echo floatval($employee_contract['abry_eligible']);

        $month = 5;
        $year = 2022;
        $company_id = 4;

        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $sundays = getSundays($month, $year, $days_in_month);
        $holidays = getHolidayDateOfCompanyByMonth($company_id, $month, $year);
        $monthly_off = array_unique(array_merge($holidays, $sundays));

        $salary = Salary::where('month', $month)
            ->where('year', $year)
            ->update(['month_days' => $days_in_month, 'week_off_days' => count($monthly_off)]);

        dd($salary);
//        dd( intval('01'));

    }
}
