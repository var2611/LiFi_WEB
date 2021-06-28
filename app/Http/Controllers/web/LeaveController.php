<?php


namespace App\Http\Controllers\web;


use App\Forms\ApplyLeaveForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\LeaveTypeTableView;
use App\Http\Livewire\MyLeaveListView;
use App\Models\LeaveType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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
    }

    public function myLeaveListView(LaravelViews $laravelViews): string
    {
        $laravelViews->create(MyLeaveListView::class)
            ->layout('main-list', 'container', [
                'title' => 'My Leave List',
                'leave' => true,
            ]);

        return $laravelViews->render();
    }

    public function empLeaveListView(LaravelViews $laravelViews): string
    {
        $laravelViews->create(MyLeaveListView::class)
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
