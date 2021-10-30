<?php

namespace App\Forms\Other;

use App\Models\EmpContractAmountType;
use App\Models\EmpContractStatus;
use App\Models\EmpContractType;
use App\Models\EmpWorkShift;
use Illuminate\Support\Arr;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class HolidayForm extends Form
{
    public function buildForm()
    {
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
