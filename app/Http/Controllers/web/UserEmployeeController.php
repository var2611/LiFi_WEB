<?php


namespace App\Http\Controllers\web;


use App\Forms\Emp\EmployeeBankDetailForm;
use App\Forms\Emp\EmployeeContractAmountTypeForm;
use App\Forms\Emp\EmployeeDepartmentDataForm;
use App\Forms\Emp\EmployeeDepartmentTypeForm;
use App\Forms\Emp\EmployeePFDetailForm;
use App\Forms\Emp\EmployeeRegistrationForAttForm;
use App\Forms\Emp\EmployeeRegistrationForm;
use App\Forms\UserRoleForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\ListEmployeeView;
use App\Http\Livewire\ListUserRole;
use App\Models\EmpBankDetail;
use App\Models\EmpContractAmountType;
use App\Models\EmpDepartmentData;
use App\Models\EmpPfDetail;
use App\Models\FormModels\DataEmpRegFor;
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
    public function editFormEmpRegistrationForAtt()
    {
        $model = new UserEmployee();
        $form = $this->createFormData(
            EmployeeRegistrationForAttForm::class,
            route('store-emp-registration-att'),
            'employee',
            $model,
            null
        );

        return view('layouts.hrms_forms', compact('form'));
    }

    /**
     * @return RedirectResponse
     */
    public function storeFormEmpRegistrationForAtt(): RedirectResponse
    {
        $formData = $this->formStoreData(EmployeeRegistrationForAttForm::class);
        $empRegForAttForm = new DataEmpRegFor($formData);
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
    public function editFormEmpRegistration(string $id)
    {
        $form = $this->editFormEmpRegistrationData($id);
        return $this->createFormView($form);
    }

    /**
     * @param string $id
     * @return Form|RedirectResponse
     */
    private function editFormEmpRegistrationData(string $id)
    {
        $model = User::where('users.id', $id)
            ->join('user_employees', 'users.id', '=', 'user_employees.user_id')
//            ->with(['UserEmployee:id,user_id,user_role_id,company_id,emp_code,flash_code'])
            ->first([
                'users.id',
                'users.name',
                'users.middle_name',
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
        return $this->createFormData(
            EmployeeRegistrationForm::class,
            route('store-emp-registration'),
            'employee',
            $model,
            null
        );
    }

    /**
     * @return RedirectResponse
     */
    public function storeFormEmpRegistration(): RedirectResponse
    {
        $formData = $this->formStoreData(EmployeeRegistrationForm::class);

        $empRegForm = new DataEmpRegFor($formData);
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
    public function editFormEmpPFDetail(string $id)
    {
        $form = $this->editFormEmpPFDetailData($id);

        return $this->createFormView($form);
    }

    /**
     * @param string $id
     * @return Form|void
     */
    private function editFormEmpPFDetailData(string $id)
    {
        $model = EmpPfDetail::whereUserId($id)->first();

//        dd($model);
        if (!$model) {
            $model = new EmpPfDetail();
            $model->user_id = $id;
        }
        return $this->createFormData(
            EmployeePFDetailForm::class,
            route('store-emp-pf-detail'),
            'employee',
            $model,
            null
        );
    }

    /**
     * @return string
     */
    public function storeFormEmpPFDetail(): string
    {
        $model = new EmpPfDetail();
        return $this->formStore(EmployeePFDetailForm::class, $model, 'list-employee', 'employee', 'PF Detail');
    }

    /**
     * @return string
     */
    public function storeFormEmpDepartmentData(): string
    {
        $model = new EmpDepartmentData();
        return $this->formStore(EmployeeDepartmentDataForm::class, $model, 'list-employee', 'employee', 'Employee Department Data');
    }

    /**
     * @param string $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function editFormEmpBankDetail(string $id)
    {
        $form = $this->editFormEmpBankDetailData($id);

        return $this->createFormView($form);
    }

    /**
     * @param string $id
     * @return Form|void
     */
    private function editFormEmpBankDetailData(string $id)
    {
        $model = EmpBankDetail::whereUserId($id)->first();

        if (!$model) {
            $model = new EmpBankDetail();
        }

        return $this->createFormData(
            EmployeeBankDetailForm::class,
            route('store-emp-bank-detail'),
            'employee',
            $model,
            null
        );
    }

    /**
     * @return RedirectResponse
     */
    public function storeFormEmpBankDetail(): RedirectResponse
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
    public function editFormEmpContractAmountType(string $id = null)
    {
        $model = new EmpContractAmountType();

        return $this->createForm(
            EmployeeContractAmountTypeForm::class,
            route('store-emp-contract-amount-type'),
            'employee',
            $model,
            $id
        );
    }

    /**
     * @return string
     */
    public function storeFormEmpContractAmountType(): string
    {
        $model = new EmpContractAmountType();

        return $this->formStore(EmployeeContractAmountTypeForm::class, $model, 'list-contract-amount-type', 'employee', 'Employee Contract Amount Type');
    }

    /**
     * @param string|null $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function editFormUserRole(string $id = null)
    {
        $model = new UserRole();
        return $this->createForm(
            UserRoleForm::class,
            route('store-user-role'),
            'employee',
            $model,
            $id
        );
    }

    /**
     * @return string
     */
    public function storeFormUserRole(): string
    {
        $model = new UserRole();
        return $this->formStore(UserRoleForm::class, $model, 'list-role', 'employee', 'User Role');
    }

    /**
     * @param string $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function editFormEmpDepartmentType(string $id)
    {
        $model = new EmpDepartmentData();
        return $this->createForm(
            EmployeeDepartmentTypeForm::class,
            route('store-emp-department-type'),
            'employee',
            $model,
            $id
        );
    }

    /**
     * @return string
     */
    public function storeFormEmpDepartmentType(): string
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
    public function listEmp(LaravelViews $laravelViews, Request $request): string
    {
        return $this->createList($laravelViews, ListEmployeeView::class, 'Employee list', 'employee');
    }

    /**
     * Show User Roles List View
     *
     * @param LaravelViews $laravelViews
     * @return string
     */
    public function listUserRoles(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, ListUserRole::class, 'User Role list', 'employee', route('edit-user-role'));
    }

    public function editUserProfile(string $id)
    {
        $user = UserEmployee::whereUserId($id)->first();
        if ($user) {
            $data = array();
            $data['formUserDetail'] = $this->editFormEmpRegistrationData($id);
            $data['formOfficeTiming'] = (new EmployeeWorkShiftController())->editFormWorkShift($id);
            $data['formDepartmentDetail'] = $this->editFormEmpDepartmentData($id);
            $data['formContractDetail'] = (new EmployeeContractController)->empContractTypeListFormCreate($id);
            $data['formBankDetail'] = $this->editFormEmpBankDetailData($id);
            $data['formPFDetail'] = $this->editFormEmpPFDetailData($id);

            return view('hrms.edit-user-profile', ['data' => $data]);
        } else {

            $this->notifyMessage(false, 'Select user is invalid. Please Contact Site Administrator.');

            return redirect()->route('list-employee');
        }
    }

    /**
     * @param string $id
     * @return Form|void
     */
    private function editFormEmpDepartmentData(string $id)
    {
        $model = EmpDepartmentData::whereUserId($id)->first();

        if (!$model) {
            $model = new EmpPfDetail();
            $model->user_id = $id;
        }
        return $this->createFormData(
            EmployeeDepartmentDataForm::class,
            route('store-emp-department-data'),
            'employee',
            $model,
            null
        );
    }
}
