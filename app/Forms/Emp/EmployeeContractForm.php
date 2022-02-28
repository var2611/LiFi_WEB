<?php

namespace App\Forms\Emp;

use App\Models\EmpContractStatus;
use App\Models\EmpContractType;
use App\Models\EmpWorkShift;
use Illuminate\Support\Arr;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class EmployeeContractForm extends Form
{
    public function buildForm()
    {
        $empWorkShift = EmpWorkShift::get(['id', 'name'])->toArray();
        $empContractType = EmpContractType::get(['id', 'name'])->toArray();
        $empContractStatuses = EmpContractStatus::get(['id', 'name'])->toArray();

        $attr = ['class' => 'form-control'];
        if ($this->getModel()->isReadOnlyData) {
            $attr = ['readonly class' => 'form-control-plaintext'];
        }

        $this
            ->add('name', Field::TEXT, [
                'attr' => ['readonly class' => 'form-control-plaintext'],
                'rules' => 'max:200'
            ])
            ->add('description', Field::TEXT, [
                'rules' => 'max:400'
            ])
            ->add('date', Field::DATE, [
                'attr' => ['readonly class' => 'form-control-plaintext'],
                'rules' => 'required'
            ])
            ->add('start_date', Field::DATE, [
                'attr' => $attr,
                'id' => 'start_date',
                'rules' => 'required'
            ])
            ->add('end_date', Field::DATE, [
                'attr' => $attr,
                'id' => 'end_date',
                'rules' => 'required'
            ])
            ->add('days', Field::TEXT, [
                'attr' => ['readonly class' => 'form-control-plaintext'],
                'id' => 'days',
                'rules' => 'required|numeric|gt:0'
            ])
            ->add('emp_work_shift_data_id', Field::SELECT, [
                'choices' => Arr::pluck($empWorkShift, 'name', 'id'),
                'empty_value' => '=== Select Shift ===',
//                'rules' => 'required',
                'label' => 'Emp work shift data',
            ])
            ->add('emp_contract_status_id', Field::SELECT, [
                'choices' => Arr::pluck($empContractStatuses, 'name', 'id'),
                'empty_value' => '=== Select Type ===',
                'rules' => 'required',
                'label' => 'Emp contract status',
            ])
            ->add('salary_basic', Field::TEXT, [
                'attr' => $attr,
                'rules' => 'numeric|gt:0'
            ])
            ->add('salary_hra', Field::TEXT, [
                'attr' => $attr,
                'rules' => 'numeric|gt:0'
            ])
            ->add('salary_total', Field::TEXT, [
                'attr' => $attr,
                'rules' => 'numeric|gt:0'
            ])
            ->add('is_active', Field::SELECT, [
                'choices' => ['0' => 'YES', '1' => 'NO'],
                'selected' => '0',
                'empty_value' => '=== Select Type ==='
            ])
            ->add('is_visible', Field::SELECT, [
                'attr' => $attr,
                'choices' => ['0' => 'YES', '1' => 'NO'],
                'selected' => '0',
                'empty_value' => '=== Select Type ==='
            ])
            ->add('id', Field::HIDDEN, [
                'value' => $this->getModel()->id ?? null
            ])
            ->add('user_id', Field::HIDDEN, [
                'value' => $this->getModel()->user_id ?? null
            ])
            ->add('emp_contract_type_id', Field::HIDDEN, [
                'value' => $this->getModel()->emp_contract_type_id ?? null
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }
}
