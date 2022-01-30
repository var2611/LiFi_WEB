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
        return $this->createList($laravelViews, ListEmpContractsView::class, 'Employees Contract List', 'contract', route('edit-emp-contract'));
    }

    public function listContractTypeView(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, ListContractsTypeView::class, 'Contract Type List', 'contract', route('edit-contract-type'));
    }

    public function listEmpContractAmountTypeView(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, ListEmployeeContractAmountType::class, 'Amount Type List', 'contract', route('edit-emp-contract-amount-type'));
    }

    /**
     * @param LaravelViews $laravelViews
     * @return string
     */
    public function listEmpContractStatusView(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, ListEmployeeContractStatus::class, 'Status List', 'contract', route('edit-emp-contract-status'));
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

            return $this->createFormData(
                EmployeeContractTypeListForm::class,
                route('edit-emp-contract-type-list'),
                'employee',
                $model,
                null
            );
        } else {
            $model->isReadOnlyData = true;
            return $this->form(EmployeeContractForm::class, [
                'method' => 'POST',
                'model' => $model,
                'url' => route('store-emp-contract'),
                'employee' => true,
                'id' => $id,
            ]);
        }

    }

    /**
     * @param string|null $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function editFormEmpContract(string $id = null, string $user_id = null)
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

        $formData = $this->createFormData(
            EmployeeContractForm::class,
            route('store-emp-contract'),
            'employee',
            $model,
            null
        );

        return $this->createFormView($formData, 'layouts.form');
    }

    /**
     * //     * @return RedirectResponse
     */
    public function storeFormEmpContract(): RedirectResponse
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
    public function editFormContractType(string $id = null)
    {
        try {

            $model = EmpContractType::whereId($id)->first();

            if (!$model) {
                $model = new EmpContractType();
                $model->date = getTodayDate();
                $model->company_id = Auth::user()->getCompanyId();
            }

            return $this->createForm(
                EmployeeContractTypeForm::class,
                route('store-contract-type'),
                'contract',
                $model
            );

        } catch (Exception $exception) {
            echo $exception->getMessage();
            $this->notifyMessage(false, 'Site Error : ' . $exception->getMessage());
            return Redirect::back();
        }
    }

    /**
     * @return RedirectResponse
     */
    public function storeFormContractType(): RedirectResponse
    {
        $model = new EmpContractType();

        return $this->formStore(EmployeeContractTypeForm::class, $model, 'list-contract-type', 'contract', 'Employee Contract Amount Type');
    }

    /**
     * @param string|null $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function editFormEmpContractStatus(string $id = null)
    {
        $model = new EmpContractStatus();

        return $this->createForm(
            EmployeeContractStatusForm::class,
            route('store-emp-contract-status'),
            'contract',
            $model,
            $id
        );
    }

    /**
     * @return RedirectResponse
     */
    public function storeFormEmpContractStatus(): RedirectResponse
    {
        $model = new EmpContractStatus();

        return $this->formStore(EmployeeContractStatusForm::class, $model, 'list-emp-contract-status', 'contract', 'Employee Contract Amount Type');

    }
}
