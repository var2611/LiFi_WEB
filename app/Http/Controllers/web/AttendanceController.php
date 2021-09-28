<?php


namespace App\Http\Controllers\web;


use App\Http\Controllers\Controller;
use App\Http\Livewire\AttendanceListEmployeesView;
use App\Http\Livewire\AttendanceListMyView;
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
    public function index(LaravelViews $laravelViews): string
    {
        $laravelViews->create(AttendanceTableView::class)
            ->layout('main-list', 'container', [
                'title' => 'Users Attendance',
                'refresh' => 'true',
                'att' => true,
            ]);

//        return view('user_employee_table', [
//            'view' => $laravelViews
//        ]);

        return $laravelViews->render();
    }

    public function empAttendanceListView(LaravelViews $laravelViews): string
    {
        $laravelViews->create(AttendanceListEmployeesView::class)
            ->layout('main-list', 'container', [
                'title' => 'Users Attendance',
                'refresh' => 'true',
                'att' => true,
            ]);

//        return view('user_employee_table', [
//            'view' => $laravelViews
//        ]);

        return $laravelViews->render();
    }

    public function myAttendanceListView(LaravelViews $laravelViews): string
    {
        $laravelViews->create(AttendanceListMyView::class)
            ->layout('main-list', 'container', [
                'title' => 'My Attendance',
                'refresh' => 'false',
                'att' => true,
            ]);

//        return view('user_employee_table', [
//            'view' => $laravelViews
//        ]);

        return $laravelViews->render();
    }

    public function att_view(string $id): string
    {
        $result = AttendanceData::whereId($id)
            ->first();
//        $la = new AttendanceDetailView($id);
        return view('main_detail', ['model' => $result, 'att' => true])->render();
    }

}
