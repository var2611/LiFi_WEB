<?php

namespace App\Forms\Emp;

use App\Models\UserRole;
use Illuminate\Support\Arr;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class EmployeeRegistrationForm extends Form
{
    public function buildForm()
    {
        $user_role = UserRole::get(['id', 'name'])->toArray();

        $this
            ->add('emp_code', Field::TEXT, [
                'rules' => 'required'
            ])
            ->add('user_role', Field::SELECT, [
                'choices' => Arr::pluck($user_role, 'name', 'id'),
                'empty_value' => '=== Select User Role ==='
            ])
            ->add('name', Field::TEXT, [
                'rules' => 'required'
            ])
            ->add('surname', Field::TEXT, [
                'rules' => 'required'
            ])
            ->add('last_name', Field::TEXT, [
                'rules' => 'required'
            ])
            ->add('mobile', Field::NUMBER, [
                'rules' => 'required'
            ])
            ->add('email', Field::EMAIL, [
                'rules' => 'required'
            ])
            ->add('password', Field::TEXT, [
                'rules' => 'required',
                'second_name' => 'password_confirmation',
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }
}
