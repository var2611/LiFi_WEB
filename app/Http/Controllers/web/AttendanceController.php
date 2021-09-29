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

    public function index()
    {

    }

    public function empAttendanceListView(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, AttendanceListEmployeesView::class, 'Employees Attendance', 'att', true);
    }

    public function myAttendanceListView(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, AttendanceListMyView::class, 'My Attendance', 'att');
    }

    public function att_view(string $id): string
    {
        $result = AttendanceData::whereId($id)
            ->first();
//        $la = new AttendanceDetailView($id);
        return view('main_detail', ['model' => $result, 'att' => true])->render();
    }

}
