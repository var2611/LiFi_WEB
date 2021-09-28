<?php

namespace App\Forms\Emp;

use App\Models\EmpContractAmountType;
use Illuminate\Support\Arr;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class EmployeeContractForm extends Form
{
    public function buildForm()
    {
        $data = EmpContractAmountType::get(['id', 'name'])->toArray();

        $this
            ->add('name', Field::TEXT, [
                'rules' => 'required|max:25'
            ])
            ->add('description', Field::TEXT, [
                'rules' => 'max:400'
            ])
            ->add('date', Field::DATE, [
                'rules' => 'required'
            ])
            ->add('start_date', Field::DATE, [
                'rules' => 'required'
            ])
            ->add('end_date', Field::DATE, [
                'rules' => 'required'
            ])
            ->add('days', Field::TEXT, [
                'rules' => 'required'
            ])
            ->add('status', Field::TEXT, [
                'rules' => 'required'
            ])
            ->add('emp_contract_amount_type_id', Field::TEXT, [
                'choices' => Arr::pluck($data, 'name', 'id'),
                'empty_value' => '=== Select Type ==='
            ])
            ->add('amount', Field::TEXT, [
                'rules' => 'required'
            ])
            ->add('is_active', Field::SELECT, [
                'choices' => ['0' => 'YES', '1' => 'NO'],
                'selected' => '0',
                'empty_value' => '=== Select Type ==='
            ])
            ->add('is_visible', Field::SELECT, [
                'choices' => ['0' => 'YES', '1' => 'NO'],
                'selected' => '0',
                'empty_value' => '=== Select Type ==='
            ])
            ->add('user_employee_id', Field::HIDDEN, [
                'value' => $this->getModel()->user_employee_id ?? null
            ])
            ->add('id', Field::HIDDEN, [
                'value' => $this->getModel()->id ?? null
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }
}
