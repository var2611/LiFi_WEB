<?php


namespace App\Http\Controllers\web;


use App\Http\Controllers\Controller;
use App\Http\Livewire\AttendanceTableView;
use App\Models\AttendanceData;
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

    /**
     * Show the application dashboard.
     *
     * @return string
     */
    public function index(LaravelViews $laravelViews)
    {
        $laravelViews->create(AttendanceTableView::class)
            ->layout('main-list', 'container', [
                'title' => 'Users Attendance',
                'refresh' => 'true',
            ]);

//        return view('user_employee_table', [
//            'view' => $laravelViews
//        ]);

        return $laravelViews->render();
    }

    public function att_view(string $id)
    {
        $result = AttendanceData::whereId($id)->first();
//        $la = new AttendanceDetailView($id);
        return view('main-detail', ['id' => $id]);
    }

}
