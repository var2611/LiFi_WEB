<?php


namespace App\Http\Controllers\web;


use App\Forms\Emp\EmployeeBankDetailForm;
use App\Forms\Emp\EmployeeContractAmountTypeForm;
use App\Forms\Emp\EmployeeDepartmentTypeForm;
use App\Forms\Emp\EmployeePFDetailForm;
use App\Forms\Emp\EmployeeRegistrationForAttForm;
use App\Forms\Emp\EmployeeRegistrationForm;
use App\Forms\TypeEditForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\ListEmployeeView;
use App\Http\Livewire\TypeList\ListUserRole;
use App\Models\EmpBankDetail;
use App\Models\EmpContractAmountType;
use App\Models\EmpDepartmentType;
use App\Models\EmpPfDetail;
use App\Models\FormModels\EmpRegForData;
use App\Models\User;
use App\Models\UserEmployee;
use App\Models\UserRole;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use LaravelViews\LaravelViews;

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
        $model = new UserEmployee();
        $form = $this->createFormData(null, EmployeeDepartmentTypeForm::class, $model, route('emp-registration-att-store'), 'employee');

        return view('layouts.hrms_forms', compact('form'));
    }

    public function empRegistrationForAttFormStore(): RedirectResponse
    {
        $formData = $this->formStoreData(EmployeeRegistrationForAttForm::class);
        $empRegForAttForm = new EmpRegForData($formData);
        $empRegForAttForm = $empRegForAttForm->attData();

        $user = att_register_user($empRegForAttForm->mobile, "New User");
        $user_employee = att_register_new_employee($empRegForAttForm, $user);

        if ($user_employee) {
            notify()->success('Employee Has Been Registered.');
        } else {
            notify()->error('Employee Registration Has some errors please try again or contact Admin.');
        }
        $data['user'] = true;

        return redirect()->route('list-employee', $data);
    }

    public function empRegistrationFormCreate(string $id)
    {
        $form = $this->empRegistrationFormCreateData($id);
        return $this->createFormView($form);
    }

    private function empRegistrationFormCreateData(string $id)
    {
        $model = User::where('users.id', $id)
            ->join('user_employees', 'users.id', '=', 'user_employees.user_id')
//            ->with(['UserEmployee:id,user_id,user_role_id,company_id,emp_code,flash_code'])
            ->first([
                'users.id',
                'users.name',
                'users.surname',
                'users.last_name',
                'users.mobile',
                'users.email',
                'users.password',
                'users.firebase_token',
                'users.mac_address',
                'users.is_active',
                'users.is_visible',
                'users.created_by',
                'users.updated_by',
                'user_employees.user_role_id',
                'user_employees.company_id',
                'user_employees.emp_code',
                'user_employees.flash_code',
            ]);
        return $this->createFormData(null, EmployeeRegistrationForm::class, $model, route('emp-registration-store'), 'employee');
    }

    public function empRegistrationFormStore(): RedirectResponse
    {
        $formData = $this->formStoreData(EmployeeRegistrationForm::class);

        $empRegForm = new EmpRegForData($formData);
        $empRegForm = $empRegForm->userData();
        $empRegForm = $empRegForm->userEmpData();

        $user = User::whereMobile($empRegForm->mobile)->first();
        $user_employee = att_register_new_employee($empRegForm, $user);

        $this->formStoreNotify($user_employee, 'Employee');
        $data['employee'] = true;
        $data['id'] = $user->id;

        return redirect()->route('edit-user-profile', $data);
    }

    public function empPFDetailFormCreate(string $id)
    {
        $form = $this->empPFDetailFormCreateData($id);

        return $this->createFormView($form);
    }

    private function empPFDetailFormCreateData(string $id)
    {
        $model = EmpPfDetail::whereUserId($id)->first();

        if (!$model) {
            $model = new EmpPfDetail();
        }
        return $this->createFormData(null, EmployeePFDetailForm::class, $model, route('emp-pf-detail-store'), 'employee');
    }

    public function empPFDetailFormStore(): string
    {
        $model = new EmpPfDetail();
        return $this->formStore(EmployeePFDetailForm::class, $model, 'list-employee', 'employee', 'PF Detail');
    }

    public function empBankDetailFormCreate(string $id)
    {
        $form = $this->empBankDetailFormCreateData($id);

        return $this->createFormView($form);
    }

    private function empBankDetailFormCreateData(string $id)
    {
        $model = EmpBankDetail::whereUserId($id)->first();

        if (!$model) {
            $model = new EmpBankDetail();
        }

        return $this->createFormData(null, EmployeeBankDetailForm::class, $model, route('emp-bank-detail-store'), 'employee');
    }

    public function empBankDetailFormStore(): RedirectResponse
    {
        $formData = $this->formStoreData(EmployeeBankDetailForm::class);

        $userID = $formData['user_id'];
        $attribute = null;
        if ($formData['id'] == null) {
            $formData['created_by'] = Auth::id();
        } else {
            $attribute['id'] = $formData['id'];
        }
        $saveData = EmpBankDetail::updateOrCreate($attribute, $formData);

        $this->formStoreNotify($saveData, 'Employee');
        $data['employee'] = true;

        return redirect()->route('edit - user - profile / ' . $userID, $data);
    }

    public function empContractAmountTypeFormCreate(string $id = null)
    {
        $model = new EmpContractAmountType();

        return $this->createForm($id, EmployeeContractAmountTypeForm::class, $model, route('emp-contract-amount-type-store'), 'employee');

    }

    public function empContractAmountTypeFormStore(): string
    {
        $model = new EmpContractAmountType();

        return $this->formStore(EmployeeContractAmountTypeForm::class, $model, 'list-employee', 'employee', 'Employee Contract Amount Type');
    }

    public function userRoleFormCreate(string $id = null)
    {
        $model = new UserRole();
        return $this->createForm($id, TypeEditForm::class, $model, route('user-role-store'), 'employee');
    }

    public function userRoleFormStore(): string
    {
        $model = new UserRole();
        return $this->formStore(TypeEditForm::class, $model, 'list-role', 'employee', 'User Role');
    }

    public function empDepartmentTypeFormCreate(string $id)
    {
        $model = new EmpDepartmentType();
        return $this->createForm($id, EmployeeDepartmentTypeForm::class, $model, route('emp-department-type-store'), 'employee');
    }

    public function empDepartmentTypeFormStore(): string
    {
        $model = new EmpDepartmentType();
        return $this->formStore(EmployeeDepartmentTypeForm::class, $model, 'list-employee', 'employee', 'Employee Department Type');
    }

    /**
     * Show the application dashboard.
     *
     * @param LaravelViews $laravelViews
     * @param Request $request
     * @return string
     */
    public function empList(LaravelViews $laravelViews, Request $request): string
    {
        return $this->createList($laravelViews, ListEmployeeView::class, 'Employee list', 'employee');
    }

    public function userRoleList(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, ListUserRole::class, 'User Role list', 'employee');
    }

    public function editUserProfile(string $id)
    {
        $user = UserEmployee::whereUserId($id)->first();
        if ($user) {
            $data = array();
            $data['formUserDetail'] = $this->empRegistrationFormCreateData($id);
            $data['formOfficeTiming'] = $this->empBankDetailFormCreateData($id);
            $data['formDepartmentDetail'] = $this->empBankDetailFormCreateData($id);
            $data['formBankDetail'] = $this->empBankDetailFormCreateData($id);
            $data['formPFDetail'] = $this->empPFDetailFormCreateData($id);

            return view('hrms.edit-user-profile', ['data' => $data]);
        } else {

            $this->notifyMessage(false, 'Select user is invalid. Please Contact Site Administrator.');

            return redirect()->route('list-employee');
        }
    }
}
