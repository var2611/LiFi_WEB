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
                'attr' => ['readonly class' => 'form-control-plaintext'],
                'rules' => 'required|max:25'
            ])
            ->add('description', Field::TEXT, [
                'rules' => 'max:400'
            ])
            ->add('date', Field::DATE, [
                'attr' => ['readonly class' => 'form-control-plaintext'],
                'rules' => 'required'
            ])
            ->add('start_date', Field::DATE, [
                'attr' => ['onchange' => 'cal()'],
                'id' => 'start_date',
                'rules' => 'required'
            ])
            ->add('end_date', Field::DATE, [
                'attr' => ['onchange' => 'cal()'],
                'id' => 'end_date',
                'rules' => 'required'
            ])
            ->add('days', Field::TEXT, [
                'id' => 'days',
                'rules' => 'required|numeric|gt:0'
            ])
            ->add('status', Field::TEXT, [
                'rules' => 'required'
            ])
            ->add('emp_contract_amount_type_id', Field::SELECT, [
                'choices' => Arr::pluck($data, 'name', 'id'),
                'empty_value' => '=== Select Type ==='
            ])
            ->add('amount', Field::TEXT, [
                'rules' => 'required|numeric|gt:0'
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
            ->add('user_id', Field::HIDDEN, [
                'value' => $this->getModel()->USER_id ?? null
            ])
            ->add('id', Field::HIDDEN, [
                'value' => $this->getModel()->id ?? null
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }
}
