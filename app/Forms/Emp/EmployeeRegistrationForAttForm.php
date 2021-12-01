<?php

namespace App\Forms\Emp;

use App\Models\UserRole;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class EmployeeRegistrationForAttForm extends Form
{
    public function buildForm()
    {
        $user_role = UserRole::get(['id', 'name'])->toArray();

        $this
            ->add('emp_code', Field::TEXT, [
                'rules' => 'required'
            ])
            ->add('name', Field::TEXT, [
                'rules' => 'required'
            ])
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
