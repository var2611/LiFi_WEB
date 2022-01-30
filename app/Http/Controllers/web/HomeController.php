<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\EmpContractAmountType;
use App\Models\EmpContractType;
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
        $user = Auth::user();
        $companyData = $user->getCompanyData();

        return view('hrms.dashboard', $companyData);
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

        $employee_contract['per_day_wages'] = null;
        $employee_contract['basic_salary'] = 100;

        if (!isset($employee_contract['per_day_wages'])) {

            echo 'passs' ."<br>";
        } else {
            echo 'Fail' ."<br>";
        }
    }
}
