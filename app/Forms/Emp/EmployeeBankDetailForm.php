<?php

namespace App\Forms\Emp;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class EmployeeBankDetailForm extends Form
{
    public function buildForm()
    {
//        print_r($this->getModel());
        $this
            ->add('bank_name', Field::TEXT, [
                'rules' => 'required|max:50'
            ])
            ->add('description', Field::TEXT, [
                'rules' => 'max:400'
            ])
            ->add('account_number', 'repeated', [
                'type' => 'number',
                'rules' => 'required',
                'attr' => ['maxlength' => '25'],
                'second_name' => 'account_number_confirmation',
                'first_options' => ['label' => 'Account number'],
                'second_options' => ['label' => 'Account number confirmation'],
            ])
            ->add('IFSC_code', Field::TEXT, [
                'rules' => 'required|max:50'
            ])
            ->add('is_active', Field::SELECT, [
                'choices' => ['0' => 'YES', '1' => 'NO'],
                'selected' => $this->getModel()->is_active ?? 0,
                'empty_value' => '=== Select Type ==='
            ])->add('is_visible', Field::SELECT, [
                'choices' => ['0' => 'YES', '1' => 'NO'],
                'selected' => $this->getModel()->is_visible ?? 0,
                'empty_value' => '=== Select Type ==='
            ])
            ->add('id', Field::HIDDEN, [
                'value' => $this->getModel()->id ?? null
            ])->add('user_id', Field::HIDDEN, [
                'value' => $this->getModel()->user_id ?? null
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }
}
