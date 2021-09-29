<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Livewire\LeaveListEmployeesView;
use App\Http\Livewire\LeaveListMyView;
use Auth;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $companyData = $user->getCompanyData();

        return view('hrms.dashboard', $companyData);
    }

    public function demo(LaravelViews $laravelViews)
    {
        notify()->connect('success', 'Updation','Employee Bank Details Updated Successfully.');
        return view('demo_table');

    }
}
