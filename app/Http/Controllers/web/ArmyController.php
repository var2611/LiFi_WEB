<?php

namespace App\Http\Controllers\web;

use App\Forms\Emp\VehicleRegistrationForArmyForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\ListArmyVehicleView;
use App\Http\Livewire\ListEmployeeView;
use App\Models\FormModels\DataEmpRegFor;
use App\Models\UserEmployee;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
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
}
