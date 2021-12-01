<?php


namespace App\Http\Controllers\web;


use App\Forms\Emp\EmployeeBankDetailForm;
use App\Forms\Emp\EmployeeContractAmountTypeForm;
use App\Forms\Emp\EmployeeDepartmentTypeForm;
use App\Forms\Emp\EmployeePFDetailForm;
use App\Forms\Emp\EmployeeRegistrationForAttForm;
use App\Forms\Emp\EmployeeRegistrationForm;
use App\Forms\UserRoleForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\ListEmployeeView;
use App\Http\Livewire\UserRoleList;
use App\Models\EmpBankDetail;
use App\Models\EmpContractAmountType;
use App\Models\EmpDepartmentData;
use App\Models\EmpPfDetail;
use App\Models\FormModels\EmpRegForData;
use App\Models\User;
use App\Models\UserEmployee;
use App\Models\UserRole;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Kris\LaravelFormBuilder\Form;
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

    /**
     * @return Application|Factory|View
     */
    public function empRegistrationForAttFormCreate()
    {
        $model = new UserEmployee();
        $form = $this->createFormData(null, EmployeeRegistrationForAttForm::class, $model, route('emp-registration-att-store'), 'employee');

        return view('layouts.hrms_forms', compact('form'));
    }

    /**
     * @return RedirectResponse
     */
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

    /**
     * @param string $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function empRegistrationFormCreate(string $id)
    {
        $form = $this->empRegistrationFormCreateData($id);
        return $this->createFormView($form);
    }

    /**
     * @param string $id
     * @return Form|RedirectResponse
     */
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

    /**
     * @return RedirectResponse
     */
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

    /**
     * @param string $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function empPFDetailFormCreate(string $id)
    {
        $form = $this->empPFDetailFormCreateData($id);

        return $this->createFormView($form);
    }

    /**
     * @param string $id
     * @return Form|void
     */
    private function empPFDetailFormCreateData(string $id)
    {
        $model = EmpPfDetail::whereUserId($id)->first();

        if (!$model) {
            $model = new EmpPfDetail();
            $model->user_id = $id;
        }
        return $this->createFormData(null, EmployeePFDetailForm::class, $model, route('emp-pf-detail-store'), 'employee');
    }

    /**
     * @return string
     */
    public function empPFDetailFormStore(): string
    {
        $model = new EmpPfDetail();
        return $this->formStore(EmployeePFDetailForm::class, $model, 'list-employee', 'employee', 'PF Detail');
    }

    /**
     * @param string $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function empBankDetailFormCreate(string $id)
    {
        $form = $this->empBankDetailFormCreateData($id);

        return $this->createFormView($form);
    }

    /**
     * @param string $id
     * @return Form|void
     */
    private function empBankDetailFormCreateData(string $id)
    {
        $model = EmpBankDetail::whereUserId($id)->first();

        if (!$model) {
            $model = new EmpBankDetail();
        }

        return $this->createFormData(null, EmployeeBankDetailForm::class, $model, route('emp-bank-detail-store'), 'employee');
    }

    /**
     * @return RedirectResponse
     */
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

        return redirect()->route('edit-user-profile/' . $userID, $data);
    }

    /**
     * @param string|null $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function empContractAmountTypeFormCreate(string $id = null)
    {
        $model = new EmpContractAmountType();

        return $this->createForm($id, EmployeeContractAmountTypeForm::class, $model, route('emp-contract-amount-type-store'), 'employee');
    }

    /**
     * @return string
     */
    public function empContractAmountTypeFormStore(): string
    {
        $model = new EmpContractAmountType();

        return $this->formStore(EmployeeContractAmountTypeForm::class, $model, 'list-contract-amount-type', 'employee', 'Employee Contract Amount Type');
    }

    /**
     * @param string|null $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function userRoleFormCreate(string $id = null)
    {
        $model = new UserRole();
        return $this->createForm($id, UserRoleForm::class, $model, route('user-role-store'), 'employee');
    }

    /**
     * @return string
     */
    public function userRoleFormStore(): string
    {
        $model = new UserRole();
        return $this->formStore(UserRoleForm::class, $model, 'list-role', 'employee', 'User Role');
    }

    /**
     * @param string $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function empDepartmentTypeFormCreate(string $id)
    {
        $model = new EmpDepartmentData();
        return $this->createForm($id, EmployeeDepartmentTypeForm::class, $model, route('emp-department-type-store'), 'employee');
    }

    /**
     * @return string
     */
    public function empDepartmentTypeFormStore(): string
    {
        $model = new EmpDepartmentData();
        return $this->formStore(EmployeeDepartmentTypeForm::class, $model, 'list-employee', 'employee', 'Employee Department Type');
    }

    /**
     * Show the Employees List View.
     *
     * @param LaravelViews $laravelViews
     * @param Request $request
     * @return string
     */
    public function empList(LaravelViews $laravelViews, Request $request): string
    {
        return $this->createList($laravelViews, ListEmployeeView::class, 'Employee list', 'employee');
    }

    /**
     * Show User Roles List View
     *
     * @param LaravelViews $laravelViews
     * @return string
     */
    public function userRoleList(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, UserRoleList::class, 'User Role list', 'employee', route('user-role-edit'));
    }

    public function editUserProfile(string $id)
    {
        $user = UserEmployee::whereUserId($id)->first();
        if ($user) {
            $data = array();
            $data['formUserDetail'] = $this->empRegistrationFormCreateData($id);
            $data['formOfficeTiming'] = $this->empBankDetailFormCreateData($id);
            $data['formDepartmentDetail'] = (new EmployeeContractController)->empContractTypeListFormCreate($id);
            $data['formContractDetail'] = (new EmployeeContractController)->empContractTypeListFormCreate($id);
            $data['formBankDetail'] = $this->empBankDetailFormCreateData($id);
            $data['formPFDetail'] = $this->empPFDetailFormCreateData($id);

            return view('hrms.edit-user-profile', ['data' => $data]);
        } else {

            $this->notifyMessage(false, 'Select user is invalid. Please Contact Site Administrator.');

            return redirect()->route('list-employee');
        }
    }
}
