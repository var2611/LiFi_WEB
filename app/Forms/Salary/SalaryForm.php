<?php

namespace App\Forms\Salary;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class SalaryForm extends Form
{
    public function buildForm()
    {

        $this
            ->add('name', Field::TEXT, [
                'rules' => 'required|max:25',
            ])
            ->add('contract_amount', Field::TEXT, [
                'attr' => ['readonly class' => 'form-control-plaintext'],
                'rules' => 'required|max:25',
            ])
            ->add('total_days', Field::TEXT, [
                'attr' => ['readonly class' => 'form-control-plaintext'],
                'rules' => 'required|max:25',
            ])
            ->add('present_days', Field::TEXT, [
                'attr' => ['readonly class' => 'form-control-plaintext'],
                'rules' => 'required|max:25',
            ])
            ->add('absent_days', Field::TEXT, [
                'attr' => ['readonly class' => 'form-control-plaintext'],
                'rules' => 'required|max:25',
            ])
            ->add('basic', Field::TEXT, [
                'attr' => ['readonly class' => 'form-control-plaintext'],
                'rules' => 'required|max:25',
            ])
            ->add('hra', Field::TEXT, [
                'attr' => ['readonly class' => 'form-control-plaintext'],
                'rules' => 'required|max:25',
                'label' => 'HRA',
            ])
            ->add('salary_amount', Field::TEXT, [
                'attr' => ['readonly class' => 'form-control-plaintext'],
                'rules' => 'required|max:25',
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
            ->add('id', Field::HIDDEN, [
                'value' => $this->getModel()->id ?? null
            ])
            ->add('add', Field::BUTTON_BUTTON, [
                'wrapper' => ['class'=> 'col-sm-6'],
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }
}
