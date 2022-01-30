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
            ])
            ->add('heading_line_number_from_sheet', Field::SELECT, [
                'choices' => $month,
                'empty_value' => '=== Select Line Number ===',
                'rules' => 'required',
            ])
            ->add('start_date', Field::DATE, [
                'attr' => ['onchange' => 'cal()'],
                'rules' => 'required',
                'label' => 'Salary Contract Start Date',
            ])
            ->add('end_date', Field::DATE, [
                'attr' => ['onchange' => 'cal()'],
                'rules' => 'required',
                'label' => 'Salary Contract End Date'
            ])
            ->add('days', Field::TEXT, [
                'id' => 'days',
                'rules' => 'required|numeric|gt:0'
            ])
            ->add('hours', Field::TEXT, [
                'rules' => 'required|numeric|gt:0',
                'label' => 'Working Hours'
            ])
            ->add('hra_cap', Field::TEXT, [
                'rules' => 'required|numeric|gt:0',
                'label' => 'HRA Cap Amount'
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }
}
