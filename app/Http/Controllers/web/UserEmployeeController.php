<?php


namespace App\Http\Controllers\web;


use App\Http\Controllers\Controller;
use App\Http\Livewire\UserEmployeeTableView;
use LaravelViews\LaravelViews;

class UserEmployeeController extends Controller
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
     * @return string
     */
    public function index(LaravelViews $laravelViews)
    {
        $laravelViews->create(UserEmployeeTableView::class)
            ->layout('main-list', 'container', [
                'title' => 'Users List'
            ]);

//        return view('user_employee_table', [
//            'view' => $laravelViews
//        ]);

        return $laravelViews->render();
    }

}
