<?php


namespace App\Http\Controllers\web;


use App\Http\Controllers\Controller;
use App\Http\Livewire\DetailAttendanceView;
use App\Http\Livewire\ListAttendanceEmployeesView;
use App\Http\Livewire\ListAttendanceMyView;
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
        return view('main_detail', ['class' => DetailAttendanceView::getName(),'model' => $result, 'att' => true])->render();
    }

}
