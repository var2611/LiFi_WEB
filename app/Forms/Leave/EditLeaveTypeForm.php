<?php

namespace App\Forms\Leave;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class EditLeaveTypeForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('data', 'collection', [
                'type' => 'form',
                'wrapper' => ['class' => 'col'],
                'label' => false,
                'options' => [    // these are options for a single type
                    'class' => 'App\Forms\Leave\EditLeaveTypeForm1',
                    'label' => false,
                ]
            ])
            ->add('tags', 'collection', [
                'type' => 'form',
                'wrapper' => ['class' => 'col'],
                'label' => false,
                'options' => [    // these are options for a single type
                    'class' => 'App\Forms\Leave\EditLeaveTypeForm2',
                    'label' => false,
                ]
            ])
            ->add('btn', 'collection', [
                'type' => 'form',
                'label' => false,
                'options' => [    // these are options for a single type
                    'class' => 'App\Forms\Leave\EditLeaveTypeForm3',
                    'label' => false,
                ]
            ]);


    }
}

class EditLeaveTypeForm1 extends Form
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
            ]);
    }
}

class EditLeaveTypeForm2 extends Form
{
    public function buildForm()
    {
        $this
            ->add('is_active', Field::SELECT, [
                'choices' => ['0' => 'YES', '1' => 'NO'],
                'selected' => $this->getModel()->is_active ?? 0,
                'empty_value' => '=== Select Type ==='
            ])
            ->add('is_visible', Field::SELECT, [
                'choices' => ['0' => 'YES', '1' => 'NO'],
                'selected' => $this->getModel()->is_visible ?? 0,
                'empty_value' => '=== Select Type ==='
            ]);
    }
}

class EditLeaveTypeForm3 extends Form
{
    public function buildForm()
    {
        $this
            ->add('clear', Field::BUTTON_RESET, [
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }
}
