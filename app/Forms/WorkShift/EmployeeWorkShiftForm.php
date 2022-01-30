<?php

namespace App\Forms\WorkShift;

use App\Models\EmpWorkShift;
use Illuminate\Support\Arr;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class EmployeeWorkShiftForm extends Form
{
    public function buildForm()
    {
        $workShiftTypes = EmpWorkShift::get(['id', 'name'])->toArray();

        $this
            ->add('name', Field::TEXT, [
                'rules' => 'required|max:25'
            ])
            ->add('description', Field::TEXT, [
                'rules' => 'max:400'
            ])
            ->add('emp_contract_type_id', Field::SELECT, [
                'choices' => Arr::pluck($workShiftTypes, 'name', 'id'),
                'empty_value' => '=== Select Type ===',
                'rules' => 'required',
                'label' => 'Select Work Shift',
            ])
            ->add('start_date', Field::DATE, [
                'attr' => ['onchange' => 'cal()'],
                'rules' => 'required',
            ])
            ->add('end_date', Field::DATE, [
                'attr' => [ 'onchange' => 'cal()'],
                'rules' => 'required',
            ])
            ->add('days', Field::TEXT, [
                'id' => 'days',
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
