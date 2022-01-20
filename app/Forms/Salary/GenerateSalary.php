<?php

namespace App\Forms\Salary;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class GenerateSalary extends Form
{
    public function buildForm()
    {
        $this
            ->add('salary_month', Field::SELECT, [
                'choices' => getMonthListArray(),
                'empty_value' => '=== Select Month ===',
                'rules' => 'required',
            ])->add('salary_year', Field::SELECT, [
                'choices' => getYearListArray(),
                'empty_value' => '=== Select Year ===',
                'rules' => 'required',
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }
}
