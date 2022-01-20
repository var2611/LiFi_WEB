<?php

namespace App\Forms\Import;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class ImportEmployeesContractDataFromSalarySheet extends Form
{

    public function buildForm()
    {
        $month = [
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
        ];
        $year = ['2021' => '2021', '2022' => '2022'];
        $this
            ->add('employees_salary_sheet', Field::FILE, [
                'attr' => ['accept' => '.xlsx'],
                'rules' => 'required',
            ])->add('heading_line_number_from_sheet', Field::SELECT, [
                'choices' => $month,
                'empty_value' => '=== Select Line Number ===',
                'rules' => 'required',
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }
}
