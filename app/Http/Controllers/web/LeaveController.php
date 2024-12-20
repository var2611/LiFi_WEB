<?php


namespace App\Http\Controllers\web;


use App\Forms\Leave\ApplyLeaveForm;
use App\Forms\Leave\EditLeaveTypeForm;
use App\Forms\UserRoleForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\ListLeaveEmployeesView;
use App\Http\Livewire\ListLeaveMyView;
use App\Http\Livewire\ListLeaveType;
use App\Models\FormModels\DataApplyLeave;
use App\Models\LeaveType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
    public function editFormApplyLeave()
    {
        $model = new DataApplyLeave(null);
        $model->user_id = Auth::id();
        $form = $this->form(ApplyLeaveForm::class, [
            'method' => 'POST',
            'model' => $model,
            'url' => route('store-leave')
        ]);

        return view('layouts.hrms_forms', compact('form'));
    }

    /**
     * @return string
     */
    public function storeFormApplyLeave(): string
    {
        $form = $this->form(ApplyLeaveForm::class);

        $form->redirectIfNotValid();

        // Do saving and other things...
        $formData = $form->getFieldValues();

        $applyLeaveForm = new DataApplyLeave($formData);

        $employee_leave = $applyLeaveForm->createEmployeeLeaveModel($applyLeaveForm);
        if ($applyLeaveForm->created_by == null) {
            $employee_leave->created_by = Auth::id();
        }
        $employee_leave->updated_by = Auth::id();
        $employee_leave->save();

        return redirect()->route('list-leave-my');

    }

    /**
     * @param string|null $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function editFormLeaveType(string $id = null)
    {
        $model = new LeaveType();
        return $this->createForm(
            EditLeaveTypeForm::class,
            route('store-leave-type'),
            'leave',
            $model,
            $id
        );
    }

    /**
     * @return RedirectResponse
     */
    public function storeFormLeaveType(): RedirectResponse
    {
        $model = new LeaveType();

        return $this->formStore(EditLeaveTypeForm::class, $model, 'list-leave-type', 'leave', 'Leave Type');
    }

    /**
     * @param LaravelViews $laravelViews
     * @return string
     */
    public function listLeaveMyView(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, ListLeaveMyView::class, 'My Leave List', 'leave');
    }

    /**
     * @param LaravelViews $laravelViews
     * @return string
     */
    public function listLeaveEmpView(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, ListLeaveEmployeesView::class, 'Employee Leave List', 'leave');
    }

    /**
     * @param LaravelViews $laravelViews
     * @return string
     */
    public function listLeaveTypeView(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, ListLeaveType::class, 'Leave Type List', 'leave', route('edit-leave-type'));
    }

    public function generate_pdf()
    {
        $model = new DataApplyLeave(null);
        $model->user_id = Auth::id();
        $form = $this->form(UserRoleForm::class, [
            'method' => 'POST',
            'model' => $model,
            'url' => route('store-leave-type')
        ]);

        $data = [
            'foo' => 'bar'
        ];
        $pdf = PDF::loadView('home', compact('form'));

//        view('layouts.hrms_forms', compact('form'));
//        return $pdf->stream('document.pdf');
    }
}
