<?php

namespace App\Forms\Emp;

use App\Models\UserRole;
use Illuminate\Support\Arr;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class EmployeeRegistrationForAttForm extends Form
{
    public function buildForm()
    {
        $armyUserRole = UserRole::whereIn('id', [6,8])->get(['id', 'name'])->toArray();

        $this
            ->add('emp_code', Field::TEXT, [
                'rules' => 'required'
            ])
            ->add('name', Field::TEXT, [
                'rules' => 'required'
            ]);

        if (\Auth::user()->isArmy()) {
            $this
                ->add('user_role_id', Field::SELECT, [
                    'choices' => Arr::pluck($armyUserRole, 'name', 'id'),
//                'choices' => ['en' => 'English', 'fr' => 'French'],
//                'selected' => function ($data) {
//                    // Returns the array of short names from model relationship data
//                    return Arr::pluck($data, 'name');
//                },
                    'empty_value' => '=== Select Role ===',
                    'label' => 'Select Role'
                ]);
        }
        $this
            ->add('last_name', Field::TEXT, [
                'rules' => 'required'
            ])
            ->add('middle_name', Field::TEXT, [
                'rules' => 'required'
            ])
            ->add('mobile', Field::TEXT, [
                'rules' => 'required|size:10'
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }
}
