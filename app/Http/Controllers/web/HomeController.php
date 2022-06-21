<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\EmpContract;
use App\Models\EmpContractAmountType;
use App\Models\EmpContractType;
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

        $salary = Salary::whereUserId(183)
            ->where('month', intval('01'))
            ->where('year', intval('2022'))
            ->first();

        dd($salary);
//        dd( intval('01'));

    }
}
