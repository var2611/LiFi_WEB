<?php


namespace App\Http\Controllers\web;


use App\Forms\Emp\EmployeeBankDetailForm;
use App\Forms\Emp\EmployeeContractAmountTypeForm;
use App\Forms\Emp\EmployeeDepartmentTypeForm;
use App\Forms\Emp\EmployeeRegistrationForAttForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\UserEmployeeTableView;
use App\Models\EmpBankDetail;
use App\Models\EmpContractAmountType;
use App\Models\EmpDepartmentType;
use App\Models\FormModels\EmpRegForAtt;
use App\Models\UserEmployee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use LaravelViews\LaravelViews;
use Request;

class UserEmployeeController extends Controller
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

    public function empRegistrationForAttFormCreate()
    {
        $form = $this->form(EmployeeRegistrationForAttForm::class, [
            'method' => 'POST',
            'url' => route('emp-registration-att-store'),
            'employee' => true,
        ]);

        return view('layouts.hrms_forms', compact('form'));
    }

    public function empRegistrationForAttFormStore(): RedirectResponse
    {
        $form = $this->form(EmployeeRegistrationForAttForm::class);

        $form->redirectIfNotValid();

        // Do saving and other things...
        $formData = $form->getFieldValues();
        $empRegForAttForm = new EmpRegForAtt($formData);

        $user = att_register_user($empRegForAttForm->mobile, "New User");
        $user_employee = att_register_new_employee($empRegForAttForm, $user);

        if ($user_employee) {
            notify()->success('Employee Has Been Registered.');
        } else {
            notify()->error('Employee Registration Has some errors please try again or contact Admin.');
        }
        $data['user'] = true;

        return redirect()->route('UsersList', $data);
    }

    public function empBankDetailFormCreate(string $id)
    {
        $userEmployee = UserEmployee::whereUserId($id)->first();
        $model = EmpBankDetail::whereUserId($id)->first();

        $form = $this->form(EmployeeBankDetailForm::class, [
            'method' => 'POST',
            'model' => $model,
            'url' => route('emp-bank-detail-store'),
            'employee' => true,
        ]);

        return view('layouts.hrms_forms', compact('form'));
    }

    public function empBankDetailFormStore(): RedirectResponse
    {
        $form = $this->form(EmployeeBankDetailForm::class);

        $form->redirectIfNotValid();

        // Do saving and other things...
        $formData = $form->getFieldValues();
        $attribute = null;
        if ($formData['id'] == null) {
            $formData['created_by'] = Auth::id();
        } else {
            $attribute['id'] = $formData['id'];
        }
        $saveData = EmpBankDetail::updateOrCreate($attribute, $formData);

        if ($saveData) {
            notify()->success('Employee Bank Details Updated Successfully.');
        } else {
            notify()->error('Employee Bank Details Update has Some Issue Please try Again.');
        }
        $data['employee'] = true;

        return redirect()->route('UsersList', $data);
    }

    public function empContractAmountTypeFormCreate(string $id = null)
    {
        $model = new EmpContractAmountType();
        return $this->createForm($id, EmployeeContractAmountTypeForm::class, $model, route('emp-contract-amount-type-store'), 'employee');

    }

    public function empContractAmountTypeFormStore(): string
    {
        $model = new EmpContractAmountType();
        return $this->saveFormData(EmployeeContractAmountTypeForm::class, $model, 'UsersList', 'employee', 'Employee Contract Amount Type');
    }

    public function empDepartmentTypeFormCreate(string $id = null)
    {
        $model = new EmpDepartmentType();
        return $this->createForm($id, EmployeeDepartmentTypeForm::class, $model, route('emp-department-type-store'), 'employee');
    }

    public function empDepartmentTypeFormStore(): string
    {
        $model = new EmpDepartmentType();

        return $this->saveFormData(EmployeeDepartmentTypeForm::class, $model, 'UsersList', 'employee', 'Employee Department Type');
    }

    /**
     * Show the application dashboard.
     *
     * @param LaravelViews $laravelViews
     * @param Request $request
     * @return string
     */
    public function index(LaravelViews $laravelViews, Request $request): string
    {
        return $this->createList($laravelViews, UserEmployeeTableView::class, 'Users List', 'employee');
    }
}
