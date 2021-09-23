<?php


namespace App\Http\Controllers\web;


use App\Forms\Leave\ApplyLeaveForm;
use App\Forms\UserRoleForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\LeaveListEmployeesView;
use App\Http\Livewire\LeaveListMyView;
use App\Http\Livewire\LeaveTypeTableView;
use App\Models\EmployeeLeave;
use App\Models\FormModels\ApplyLeave;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use LaravelViews\LaravelViews;
use PDF;

class LeaveController extends Controller
{
    use FormBuilderTrait;

    /**
     * @return Application|Factory|View
     */
    public function applyLeaveFormCreate()
    {
        $model = new ApplyLeave(null);
        $model->user_id = Auth::id();
        $form = $this->form(ApplyLeaveForm::class, [
            'method' => 'POST',
            'model' => $model,
            'url' => route('leave-store')
        ]);

        return view('layouts.hrms_forms', compact('form'));
    }

    /**
     * @return string
     */
    public function applyLeaveFormStore(): string
    {
        $form = $this->form(ApplyLeaveForm::class);

        $form->redirectIfNotValid();

        // Do saving and other things...
        $formData = $form->getFieldValues();

        $employee_leave = new EmployeeLeave();
        $applyLeaveForm = new ApplyLeave($formData);

        $employee_leave = $applyLeaveForm->createEmployeeLeaveModel($applyLeaveForm);
        if ($applyLeaveForm->created_by == null) {
            $employee_leave->created_by = Auth::id();
        }
        $employee_leave->updated_by = Auth::id();
        $employee_leave->save();

        return route('leave-list-my');

    }

    public function editLeaveTypeView()
    {
        $title = "Apply Leave";

        $model = new ApplyLeave(null);
        $model->user_id = Auth::id();
        $form = $this->form(UserRoleForm::class, [
            'method' => 'POST',
            'model' => $model,
            'url' => route('leave-type-store')
        ]);

        return view('layouts.hrms_forms', compact('form'));
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

    public function generate_pdf()
    {
        $model = new ApplyLeave(null);
        $model->user_id = Auth::id();
        $form = $this->form(UserRoleForm::class, [
            'method' => 'POST',
            'model' => $model,
            'url' => route('leave-type-store')
        ]);

        $data = [
            'foo' => 'bar'
        ];
        $pdf = PDF::loadView('home', compact('form'));

//        view('layouts.hrms_forms', compact('form'));
        return $pdf->stream('document.pdf');
    }
}
