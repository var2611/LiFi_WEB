<?php

namespace App\Http\Controllers\web;

use App\Forms\Emp\EmployeeRegistrationForm;
use App\Forms\Emp\VehicleModificationForArmyForm;
use App\Forms\Emp\VehicleRegistrationForArmyForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\ListArmyVehicleView;
use App\Http\Livewire\ListEmployeeView;
use App\Models\FormModels\DataEmpRegFor;
use App\Models\User;
use App\Models\UserEmployee;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Kris\LaravelFormBuilder\Form;
use LaravelViews\LaravelViews;

class ArmyController extends Controller
{
    public function index(){
        return view('army.dashboard');
    }

    /**
     * Show the Employees List View.
     *
     * @param LaravelViews $laravelViews
     * @param Request $request
     * @return string
     */
    public function listVehicle(LaravelViews $laravelViews, Request $request): string
    {
        return $this->createList($laravelViews, ListArmyVehicleView::class, 'Vehicle list', 'vehicle');
    }

    /**
     * @return RedirectResponse
     */
    public function storeFormVehicleRegistrationForArmy(): RedirectResponse
    {
        $formData = $this->formStoreData(VehicleRegistrationForArmyForm::class);
        $empRegForAttForm = new DataEmpRegFor($formData);
        $empRegForAttForm = $empRegForAttForm->attData();

        $user = att_register_user($empRegForAttForm->emp_code, "New User");
        $user_employee = att_register_new_employee($empRegForAttForm, $user);

        if ($user_employee) {
            notify()->success('Vehicle Has Been Registered.');
        } else {
            notify()->error('Vehicle Registration Has some errors please try again or contact Admin.');
        }
        $data['user'] = true;

        return redirect()->route('list-vehicle', $data);
    }


    /**
     * @return Application|Factory|View
     */
    public function editFormVehicleRegistrationForArmy()
    {
        $model = new UserEmployee();
        $form = $this->createFormData(
            VehicleRegistrationForArmyForm::class,
            route('store-vehicle-registration-army'),
            'employee',
            $model
        );

        return view('layouts.hrms_forms', compact('form'));
    }

    public function editArmyVehicleProfile(string $id)
    {
        $user = UserEmployee::whereUserId($id)->first();
        if ($user) {
            $data = array();
            $data['formUserDetail'] = $this->editFormVehicleModificationData($id);

            return view('army.edit-user-profile', ['data' => $data]);
        } else {

            $this->notifyMessage(false, 'Selected user is invalid. Please Contact Site Administrator.');

            return redirect()->route('list-employee');
        }
    }

    public function editArmyProfile(string $id)
    {
        $user = UserEmployee::whereUserId($id)->first();
        if ($user) {
            $data = array();
            $data['formUserDetail'] = $this->editFormEmpRegistrationData($id);

            return view('army.edit-user-profile', ['data' => $data]);
        } else {

            $this->notifyMessage(false, 'Selected user is invalid. Please Contact Site Administrator.');

            return redirect()->route('list-employee');
        }
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
     * @param string $id
     * @return Form|RedirectResponse
     */
    private function editFormVehicleModificationData(string $id)
    {
        $model = User::where('users.id', $id)
            ->join('user_employees', 'users.id', '=', 'user_employees.user_id')
            ->join('vehicle_drivers', 'users.id', '=', 'vehicle_drivers.vehicle_id')
            ->first([
                'users.id',
                'users.name',
                'users.mobile',
                'users.is_active',
                'users.is_visible',
                'users.created_by',
                'users.updated_by',
                'user_employees.emp_code',
                'user_employees.flash_code',
                'vehicle_drivers.driver_id',
            ]);
        return $this->createFormData(
            VehicleModificationForArmyForm::class,
            route('store-emp-registration'),
            'employee',
            $model,
            null
        );
    }

    /**
     * @return RedirectResponse
     */
    public function storeFormVehicleModification(): RedirectResponse
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

}
