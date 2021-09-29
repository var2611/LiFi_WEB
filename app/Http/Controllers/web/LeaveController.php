<?php


namespace App\Http\Controllers\web;


use App\Forms\Leave\ApplyLeaveForm;
use App\Forms\Leave\EditLeaveTypeForm;
use App\Forms\UserRoleForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\LeaveListEmployeesView;
use App\Http\Livewire\LeaveListMyView;
use App\Http\Livewire\LeaveTypeTableView;
use App\Http\Livewire\TypeList\LeaveTypeList;
use App\Models\FormModels\ApplyLeave;
use App\Models\LeaveType;
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

        $applyLeaveForm = new ApplyLeave($formData);

        $employee_leave = $applyLeaveForm->createEmployeeLeaveModel($applyLeaveForm);
        if ($applyLeaveForm->created_by == null) {
            $employee_leave->created_by = Auth::id();
        }
        $employee_leave->updated_by = Auth::id();
        $employee_leave->save();

        return redirect()->route('leave-list-my');

    }

    public function leaveTypeCreate(string $id = null)
    {
        $model = new LeaveType();
        return $this->createForm($id, EditLeaveTypeForm::class, $model, route('leave-type-store'), 'leave');
    }

    public function leaveTypeStore(): string
    {
        $model = new LeaveType();
        return $this->saveFormData(EditLeaveTypeForm::class, $model, 'leave-type-list', 'leave', 'Leave Type');
    }

    public function myLeaveListView(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, LeaveListMyView::class, 'My Leave List', 'leave');
    }

    public function empLeaveListView(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, LeaveListEmployeesView::class, 'Employee Leave List', 'leave');
    }

    public function typeLeaveListView(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, LeaveTypeList::class, 'Leave Type List', 'leave');
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
