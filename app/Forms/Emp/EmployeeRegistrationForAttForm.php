<?php

namespace App\Forms\Emp;

use App\Models\EmpDepartmentType;
use App\Models\UserRole;
use Illuminate\Support\Arr;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class EmployeeRegistrationForAttForm extends Form
{
    public function buildForm()
    {
        $armyUserRole = UserRole::whereIn('id', [6,8])->get(['id', 'name'])->toArray();
        $emp_team = EmpDepartmentType::whereIn('company_id', [1])
            ->get(['id', 'name'])
            ->filter(function ($item) {
                return !is_null($item['id']) && !is_null($item['name']);
            })
            ->toArray();
        $user_role = UserRole::whereIn('id', [10])->get(['id', 'name'])->toArray();
        $model = $this->getModel();

        $this

            ->add('name', Field::TEXT, [
                'rules' => 'required'
            ])

            ->add('last_name', Field::TEXT, [
                'rules' => 'required'
            ])
            ->add('emp_code', Field::TEXT, [
                'rules' => 'required'
            ])
            ->add('mobile', Field::TEXT, [
                'rules' => 'required|size:10'
            ])
            ->add('user_role_id', Field::SELECT, [
                'label' => 'Designation',  // Field name used
                'choices' => Arr::pluck($user_role, 'name', 'id'),
                'selected' => $this->getModel()->user_role_id ?? null,
                'empty_value' => ' Select Employee Designation ',
                'rules' => 'required'

            ])
            ->add('date_of_joining', Field::DATE, [
                'attr' => ['onchange' => 'cal()'],
                'wrapper' => ['class' => 'date-picker-wrapper'],
                'rules' => 'required',
                'id' => 'date_of_joining',
            ])
            ->add('emp_department_type_id', Field::SELECT, [
                'label' => 'Team',  // Field name used
                'choices' => Arr::pluck($emp_team, 'name', 'id'),
                'selected' => $this->getModel()->emp_department_type_id ?? null,
                'empty_value' => ' Select Employee Team ',
                'rules' => 'required'
            ])
            ->add('blood_group', Field::SELECT, [
                'choices' => ['O-' => 'O-', 'O+' => 'O+', 'A-' => 'A-', 'A+' => 'A+', 'B-' => 'B-', 'B+' => 'B+', 'AB-' => 'AB-' ,'AB+' => 'AB+'],
                'selected' => $this->getModel()->blood_group ?? null,
                'empty_value' => ' Select Blood Group ',
                'rules' => 'required'
            ])
            ->add('date_of_birth', Field::DATE, [
                'attr' => ['onchange' => 'cal()'],
                'wrapper' => ['class' => 'date-picker-wrapper'],
                'rules' => 'required',
                'id' => 'date_of_birth',
            ])

            ->add('id_photo',Field::FILE,[
                'rules' => 'file|mimes:jpg,jpeg,png|max:2048',
                'label' => 'Upload Id card Photo ',

                'attr' => [
                    'id' => 'icardPhoto',
                    'class' => 'file-input mt-2',
                    'data-max-size' => 2048,
                ],
                'value' => null, // Ensure file inputs aren't pre-filled
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

            ->add('submit', Field::BUTTON_SUBMIT, [
                'attr' => [
                    'class' => 'btn btn-success mt-2',
                ]
            ]);
    }
}
