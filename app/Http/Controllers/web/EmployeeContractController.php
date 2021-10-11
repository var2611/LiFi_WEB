<?php

namespace App\Http\Controllers\web;

use App\Forms\Emp\EmployeeContractForm;
use App\Forms\Emp\EmployeeContractStatusForm;
use App\Forms\Emp\EmployeeContractTypeForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\ListContractsTypeView;
use App\Http\Livewire\ListEmpContractsView;
use App\Http\Livewire\ListEmployeeContractAmountType;
use App\Http\Livewire\ListEmployeeContractStatus;
use App\Models\EmpContract;
use App\Models\EmpContractStatus;
use App\Models\EmpContractType;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Kris\LaravelFormBuilder\Form;
use LaravelViews\LaravelViews;

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
     * @param string|null $id
     * @return Form|RedirectResponse
     */
    public function empContractFormCreate(string $id = null)
    {
        $model = EmpContract::whereUserId($id)->first();

        if (!$model) {
            $model = new EmpContract();
            $model->user_id = $id;
            $model->name = getUserFullName($id);
            $model->date = getTodayDate();
        }

        return $this->createFormData(null, EmployeeContractForm::class, $model, route('emp-contract-store'), 'employee');
    }

    /**
     * @return RedirectResponse
     */
    public function empContractFormStore(): RedirectResponse
    {
        $model = new EmpContract();

        return $this->formStore(EmployeeContractForm::class, $model, 'list-emp-contract', 'employee', 'Employee Contract Amount Type');
    }

    /**
     * @param string|null $id
     * @return Form|RedirectResponse
     */
    public function contractTypeFormCreate(string $id = null)
    {
        try {

            $model = EmpContractType::whereId($id)->first();

            if (!$model) {
                $model = new EmpContractType();
                $model->date = getTodayDate();
            }

            return $this->createForm(null, EmployeeContractTypeForm::class, $model, route('emp-contract-store'), 'employee');

        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * @return RedirectResponse
     */
    public function contractTypeFormStore(): RedirectResponse
    {
        $model = new EmpContract();

        return $this->formStore(EmployeeContractForm::class, $model, 'list-contract-type', 'employee', 'Employee Contract Amount Type');
    }

    /**
     * @param string|null $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function empContractStatusFormCreate(string $id = null)
    {
        $model = new EmpContractStatus();

        return $this->createForm($id, EmployeeContractStatusForm::class, $model, route('emp-contract-status-store'), 'employee');
    }

    /**
     * @return RedirectResponse
     */
    public function empContractStatusFormStore(): RedirectResponse
    {
        $model = new EmpContractStatus();

        return $this->formStore(EmployeeContractStatusForm::class, $model, 'list-emp-contract-status', 'employee', 'Employee Contract Amount Type');

    }
}
