<?php

namespace App\Forms\Emp;

use App\Models\UserEmployee;
use Auth;
use Illuminate\Support\Arr;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class VehicleRegistrationForArmyForm extends Form
{
    public function buildForm()
    {
        $driverList = UserEmployee::whereUserRoleId(8)
            ->whereCompanyId(Auth::user()->getCompanyId())
            ->with(['User:id,name'])
            ->get()
            ->toArray();

        $this
            ->add('emp_code', Field::TEXT, [
                'rules' => 'required',
                'label' => 'Vehicle Number'
            ])
            ->add('driver_id', Field::SELECT, [
                'choices' => Arr::pluck($driverList, 'emp_code', 'id'),
//                'choices' => ['en' => 'English', 'fr' => 'French'],
//                'selected' => function ($data) {
//                    // Returns the array of short names from model relationship data
//                    return Arr::pluck($data, 'name');
//                },
                'empty_value' => '=== Select Driver ===',
                'label' => 'Driver Employee Code',
                'rules' => 'required'
            ])
            ->add('name', Field::TEXT, [
                'rules' => 'required'
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }
}
