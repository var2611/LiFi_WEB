<?php

namespace App\Http\Controllers\web;

use App\Forms\Emp\EmployeeContractForm;
use App\Forms\Emp\EmployeeContractStatusForm;
use App\Forms\Emp\EmployeeContractTypeForm;
use App\Forms\Emp\EmployeeContractTypeListForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\ListContractsTypeView;
use App\Http\Livewire\ListEmpContractsView;
use App\Http\Livewire\ListEmployeeContractAmountType;
use App\Http\Livewire\ListEmployeeContractStatus;
use App\Models\EmpContract;
use App\Models\EmpContractStatus;
use App\Models\EmpContractType;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\Form;
use LaravelViews\LaravelViews;
use Redirect;

class EmployeeContractController extends Controller
{

    public function listEmpContractView(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, ListEmpContractsView::class, 'Employees Contract List', 'contract', route('emp-contract-edit'));
    }

    public function listContractTypeView(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, ListContractsTypeView::class, 'Contract Type List', 'contract', route('contract-type-edit'));
    }

    public function listEmpContractAmountTypeView(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, ListEmployeeContractAmountType::class, 'Amount Type List', 'contract', route('emp-contract-amount-type-edit'));
    }

    /**
     * @param LaravelViews $laravelViews
     * @return string
     */
    public function listEmpContractStatusView(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, ListEmployeeContractStatus::class, 'Status List', 'contract', route('emp-contract-status-edit'));
    }

    /**
     * @return Form|RedirectResponse
     */
    public function empContractTypeListFormCreate(string $id)
    {

        $model = EmpContract::whereUserId($id)->whereIsActive(0)->first();


        if (empty($model)) {
            $model = new EmpContract();
            $model->user_id = $id;

            return $this->createFormData(null, EmployeeContractTypeListForm::class, $model, route('emp-contract-type-list-edit'), 'employee');
        } else {
            $model->isReadOnlyData = true;
            return $this->form(EmployeeContractForm::class, [
                'method' => 'POST',
                'model' => $model,
                'url' => route('emp-contract-store'),
                'employee' => true,
                'id' => $id,
            ]);
        }

    }

    /**
     * @param string|null $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function empContractFormCreate(string $id = null, string $user_id = null)
    {
        $empContractType = EmpContractType::whereId($id)->first();
        $model = EmpContract::whereUserId($user_id)->first();

        if (empty($model)) {
            $model = new EmpContract();
            $model->user_id = $user_id;
            $model->name = getUserFullName($user_id);
            $model->date = getTodayDate();
            $model->description = $empContractType->description;
            $model->start_date = $empContractType->start_date;
            $model->end_date = $empContractType->end_date;
            $model->days = $empContractType->days;
            $model->hours = $empContractType->working_hours;
            $model->emp_contract_type_id = $empContractType->id;
            $model->salary_basic = $empContractType->salary_basic;
            $model->salary_hra = $empContractType->salary_hra;
            $model->salary_total = $empContractType->salary_total;
        }

        $formData = $this->createFormData(null, EmployeeContractForm::class, $model, route('emp-contract-store'), 'employee');

        return $this->createFormView($formData, 'layouts.form');
    }

    /**
     * //     * @return RedirectResponse
     */
    public function empContractFormStore(): RedirectResponse
    {
        $formData = $this->formStoreData(EmployeeContractForm::class);

        $empContract = edit_emp_contract($formData);

        if (empty($empContract)) {
            $this->notifyMessage(false, 'Employee Contract edit has some issue please contact site Administrator.');
        }

        return redirect()->route('list-employee');
    }

    /**
     * @param string|null $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function contractTypeFormCreate(string $id = null)
    {
        try {

            $model = EmpContractType::whereId($id)->first();

            if (!$model) {
                $model = new EmpContractType();
                $model->date = getTodayDate();
                $model->company_id = Auth::user()->getCompanyId();
            }

            return $this->createForm(null, EmployeeContractTypeForm::class, $model, route('contract-type-store'), 'contract');

        } catch (Exception $exception) {
            echo $exception->getMessage();
            $this->notifyMessage(false, 'Site Error : ' . $exception->getMessage());
            return Redirect::back();
        }
    }

    /**
     * @return RedirectResponse
     */
    public function contractTypeFormStore(): RedirectResponse
    {
        $model = new EmpContractType();

        return $this->formStore(EmployeeContractTypeForm::class, $model, 'list-contract-type', 'contract', 'Employee Contract Amount Type');
    }

    /**
     * @param string|null $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function empContractStatusFormCreate(string $id = null)
    {
        $model = new EmpContractStatus();

        return $this->createForm($id, EmployeeContractStatusForm::class, $model, route('emp-contract-status-store'), 'contract');
    }

    /**
     * @return RedirectResponse
     */
    public function empContractStatusFormStore(): RedirectResponse
    {
        $model = new EmpContractStatus();

        return $this->formStore(EmployeeContractStatusForm::class, $model, 'list-emp-contract-status', 'contract', 'Employee Contract Amount Type');

    }
}
