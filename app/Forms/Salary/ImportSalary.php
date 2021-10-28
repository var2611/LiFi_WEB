<?php

namespace App\Forms\Salary;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class ImportSalary extends Form
{
    public function buildForm()
    {
        $this
            ->add('salary_sheet', Field::FILE, [
                'attr' => ['accept' => '.xls,.xlsx,.csv'],
                'rules' => 'required',
            ])
//            ->add('id', Field::HIDDEN, [
//                'value' => $this->getModel()->id ?? null
//            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }
}
