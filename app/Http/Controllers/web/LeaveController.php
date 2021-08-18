<?php


namespace App\Http\Controllers\web;


use App\Forms\ApplyLeaveForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\LeaveListEmployeesView;
use App\Http\Livewire\LeaveListMyView;
use App\Http\Livewire\LeaveTypeTableView;
use App\Models\EmployeeLeave;
use App\Models\LeaveType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilder;
use LaravelViews\LaravelViews;

class LeaveController extends Controller
{
    public function doApply()
    {
        $leaves = LeaveType::get();
        return view('hrms.leave.apply_leave', compact('leaves'));
    }

    public function showLeaveType(LaravelViews $laravelViews): string
    {
        $laravelViews->create(LeaveTypeTableView::class)
            ->layout('main-list', 'container', [
                'title' => 'Leave Type List',
                'leave' => true,
            ]);

        return $laravelViews->render();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return Application|Factory|View
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(ApplyLeaveForm::class, [
            'method' => 'POST',
            'url' => route('leave-store')
        ]);

        return view('layouts.hrms_forms', compact('form'));
    }

    public function store(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(ApplyLeaveForm::class);

        $form->redirectIfNotValid();

        // Do saving and other things...
        $emp_leave_data = $form->getFieldValues();
//        print_r($emp_leave_data);

        $employee_leave = new EmployeeLeave();
        $employee_leave->user_id = Auth::id();
        $employee_leave->leave_type_id = $emp_leave_data['leave_type'];
        $employee_leave->date_from = $emp_leave_data['date_from'];
        $employee_leave->date_to = $emp_leave_data['date_to'];
        $employee_leave->from_time = $emp_leave_data['from_time'];
        $employee_leave->to_time = $emp_leave_data['to_time'];
        $employee_leave->days = $emp_leave_data['days'];
        $employee_leave->reason = $emp_leave_data['reason'];
        $employee_leave->created_by = Auth::id();
        $employee_leave->updated_by = Auth::id();
        $employee_leave->save();

        print_r($employee_leave);
    }

    public function myLeaveListView(LaravelViews $laravelViews): string
    {
        $laravelViews->create(LeaveListMyView::class)
            ->layout('main-list', 'container', [
                'title' => 'My Leave List',
                'leave' => true,
            ]);

        return $laravelViews->render();
    }

    public function empLeaveListView(LaravelViews $laravelViews): string
    {
        $laravelViews->create(LeaveListEmployeesView::class)
            ->layout('main-list', 'container', [
                'title' => 'Employee Leave List',
                'leave' => true,
            ]);

        return $laravelViews->render();
    }

    public function typeLeaveListView(LaravelViews $laravelViews): string
    {
        $laravelViews->create(LeaveTypeTableView::class)
            ->layout('main-list', 'container', [
                'title' => 'Leave Type List',
                'leave' => true,
            ]);

        return $laravelViews->render();
    }
}
