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
                'attr' => ['readonly class' => 'form-control-plaintext'],
                'rules' => 'required|max:200',
            ])
            ->add('emp_code', Field::TEXT, [
                'attr' => ['readonly class' => 'form-control-plaintext'],
                'rules' => 'required|max:200',
            ])
            ->add('salary_contract_total', Field::NUMBER, [
                'attr' => ['readonly class' => 'form-control-plaintext', 'step' => 'any'],
                'rules' => 'required',
            ])
            ->add('salary_contract_basic', Field::NUMBER, [
                'attr' => ['readonly class' => 'form-control-plaintext', 'step' => 'any'],
                'rules' => 'required',
            ])
            ->add('salary_contract_hra', Field::NUMBER, [
                'attr' => ['readonly class' => 'form-control-plaintext', 'step' => 'any'],
                'rules' => 'required',
            ])
            ->add('total_days', Field::NUMBER, [
                'attr' => ['readonly class' => 'form-control-plaintext', 'step' => 'any'],
                'id' => 'total_days',
                'rules' => 'required',
            ])
            ->add('present_days', Field::NUMBER, [
                'attr' => ['onchange' => 'calculateABDays()', 'step' => 'any'],
                'id' => 'present_days',
                'rules' => 'required',
            ])
            ->add('absent_days', Field::NUMBER, [
                'attr' => ['readonly class' => 'form-control-plaintext', 'step' => 'any'],
                'id' => 'absent_days',
                'rules' => 'required',
            ])
            ->add('salary_basic', Field::NUMBER, [
                'attr' => ['onchange' => 'calculateSalary()', 'step' => 'any'],
                'id' => 'salary_basic',
                'rules' => 'required',
            ])
            ->add('salary_hra', Field::NUMBER, [
                'attr' => ['onchange' => 'calculateSalary()', 'step' => 'any'],
                'id' => 'salary_hra',
                'rules' => 'required',
            ])
            ->add('salary_total', Field::NUMBER, [
                'attr' => ['readonly class' => 'form-control-plaintext', 'step' => 'any'],
                'id' => 'salary_total',
                'rules' => 'required',
            ])
            ->add('salary_pf', Field::NUMBER, [
                'attr' => ['onchange' => 'calculateSalary()', 'step' => 'any'],
                'id' => 'salary_pf',
                'rules' => 'required',
            ])
            ->add('salary_advance', Field::NUMBER, [
                'attr' => ['onchange' => 'calculateSalary()', 'step' => 'any'],
                'id' => 'salary_advance',
                'rules' => 'required',
            ])
            ->add('salary_gross_earning', Field::NUMBER, [
                'attr' => ['readonly class' => 'form-control-plaintext', 'step' => 'any'],
                'id' => 'salary_gross_earning',
                'rules' => 'required',
            ])
            ->add('salary_gross_deduction', Field::NUMBER, [
                'attr' => ['readonly class' => 'form-control-plaintext', 'step' => 'any'],
                'id' => 'salary_gross_deduction',
                'rules' => 'required',
            ])
            ->add('salary_net_pay', Field::NUMBER, [
                'attr' => ['readonly class' => 'form-control-plaintext', 'step' => 'any'],
                'id' => 'salary_net_pay',
                'rules' => 'required',
            ])
            ->add('salary_id', Field::HIDDEN, [
                'value' => $this->getModel()->salary_id ?? null
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }
}
