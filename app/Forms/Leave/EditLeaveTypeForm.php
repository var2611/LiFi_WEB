<?php

namespace App\Forms\Leave;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class EditLeaveTypeForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', Field::TEXT, [
                'rules' => 'required|max:25',
            ])
            ->add('description', Field::TEXTAREA, [
                'rules' => 'max:400',
            ])
            ->add('id', Field::HIDDEN, [
                'value' => $this->getModel()->id ?? null
            ])
            ->add('name', Field::TEXT, [
                'wrapper' => ['class' => 'col'],
                'rules' => 'required|max:25',
            ])
            ->add('description', Field::TEXTAREA, [
                'wrapper' => ['class' => 'col'],
                'rules' => 'max:400',
            ])
            ->add('is_active', Field::SELECT, [
                'choices' => ['0' => 'YES', '1' => 'NO'],
                'selected' => $this->getModel()->is_active ?? 0,
                'empty_value' => '=== Select Type ==='
            ])
            ->add('is_visible', Field::SELECT, [
                'choices' => ['0' => 'YES', '1' => 'NO'],
                'selected' => $this->getModel()->is_visible ?? 0,
                'empty_value' => '=== Select Type ==='
            ])
            ->add('clear', Field::BUTTON_RESET, [
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }
}
