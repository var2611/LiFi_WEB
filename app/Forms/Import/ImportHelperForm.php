<?php

namespace App\Forms\Import;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class ImportHelperForm extends Form
{
    public function buildForm(){

        $line_number = [
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
        ];

        $this
            ->add('xlsx_file', Field::FILE, [
                'attr' => ['accept' => '.xlsx'],
                'rules' => 'required',
            ])
            ->add('heading_line_number_from_sheet', Field::SELECT, [
                'choices' => $line_number,
                'empty_value' => '=== Select Line Number ===',
                'rules' => 'required',
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }

}
