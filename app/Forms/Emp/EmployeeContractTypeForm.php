<?php

namespace App\Forms\Emp;

use App\Models\EmpContractAmountType;
use App\Models\EmpContractStatus;
use App\Models\EmpContractType;
use App\Models\EmpWorkShift;
use Illuminate\Support\Arr;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class EmployeeContractTypeForm extends Form
{
    public function buildForm()
    {
        $contractTypes = EmpContractType::get(['id', 'name'])->toArray();
        $empContractAmountTypes = EmpContractAmountType::get(['id', 'name'])->toArray();
        $empContractStatuses = EmpContractStatus::get(['id', 'name'])->toArray();
        $empWorkShift = EmpWorkShift::get(['id', 'name'])->toArray();

        $this
            ->add('name', Field::TEXT, [
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
            ->add('working_hours', Field::TEXT, [
                'id' => 'days',
                'rules' => 'numeric|gt:0'
            ])
            ->add('emp_contract_status_id', Field::SELECT, [
                'choices' => Arr::pluck($empContractStatuses, 'name', 'id'),
                'empty_value' => '=== Select Type ===',
                'rules' => 'required',
                'label' => 'Status',
            ])
            ->add('emp_contract_amount_type_id', Field::SELECT, [
                'choices' => Arr::pluck($empContractAmountTypes, 'name', 'id'),
                'empty_value' => '=== Select Type ===',
                'rules' => 'required',
                'label' => 'Amount Type',
            ])
            ->add('amount', Field::TEXT, [
                'rules' => 'numeric|gte:0'
            ])
            ->add('emp_work_shift_id', Field::SELECT, [
                'choices' => Arr::pluck($empWorkShift, 'name', 'id'),
                'empty_value' => '=== Select Type ===',
                'rules' => 'required',
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
            ->add('id', Field::HIDDEN, [
                'value' => $this->getModel()->id ?? null
            ])
            ->add('company_id', Field::HIDDEN, [
                'value' => $this->getModel()->company_id ?? null
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }
}
