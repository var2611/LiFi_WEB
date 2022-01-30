<?php

namespace App\Forms\WorkShift;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class WorkShiftForm extends Form
{
    public function buildForm()
    {
        $mon = 0;
        $tue = 0;
        $wed = 0;
        $thur = 0;
        $fri = 0;
        $sat = 0;
        $sun = 0;

        if ($this->getModel()) {
            $mon = !$this->getModel()->EmpWorkShift->mon ?? 0;
            $tue = !$this->getModel()->EmpWorkShift->tue ?? 0;
            $wed = !$this->getModel()->EmpWorkShift->wed ?? 0;
            $thur = !$this->getModel()->EmpWorkShift->thur ?? 0;
            $fri = !$this->getModel()->EmpWorkShift->fri ?? 0;
            $sat = !$this->getModel()->EmpWorkShift->sat ?? 0;
            $sun = !$this->getModel()->EmpWorkShift->sun ?? 1;
        }

        $this
            ->add('name', Field::TEXT, [
                'rules' => 'required|max:25'
            ])
            ->add('description', Field::TEXT, [
                'rules' => 'max:400'
            ])
            ->add('start_time', Field::TIME, [
//                'attr' => ['readonly class' => 'form-control-plaintext'],
                'rules' => 'required'
            ])->add('end_time', Field::TIME, [
//                'attr' => ['readonly class' => 'form-control-plaintext'],
                'rules' => 'required'
            ])->add('mon', Field::CHECKBOX, [
                'value' => 0,
                'checked' => $mon,
//                'attr' => ['readonly class' => 'form-control-plaintext'],
            ])
            ->add('tue', Field::CHECKBOX, [
                'value' => 0,
                'checked' => $tue,
//                'attr' => ['readonly class' => 'form-control-plaintext'],
            ])
            ->add('wed', Field::CHECKBOX, [
                'value' => 0,
                'checked' => $wed,
//                'attr' => ['readonly class' => 'form-control-plaintext'],
            ])
            ->add('thur', Field::CHECKBOX, [
                'value' => 0,
                'checked' => $thur,
//                'attr' => ['readonly class' => 'form-control-plaintext'],
            ])
            ->add('fri', Field::CHECKBOX, [
                'value' => 0,
                'checked' => $fri,
//                'attr' => ['readonly class' => 'form-control-plaintext'],
            ])
            ->add('sat', Field::CHECKBOX, [
                'value' => 0,
                'checked' => $sat,
//                'attr' => ['readonly class' => 'form-control-plaintext'],
            ])
            ->add('sun', Field::CHECKBOX, [
                'value' => 0,
                'checked' => $sun,
//                'attr' => ['readonly class' => 'form-control-plaintext'],
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
