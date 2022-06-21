<?php

namespace App\Forms\Import;

use Illuminate\Support\Arr;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class ImportLatLongDataForm extends Form
{
    public function buildForm()
    {
        $fileType = [
            '01' => 'Internet Data',
            '02' => 'Non Internet Data',
        ];

        $heading_lines = [
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
        ];

        $this
            ->add('import_lat_long_sheet', Field::FILE, [
                'attr' => ['accept' => '.xlsx'],
                'rules' => 'required',
            ])
            ->add('file_type', Field::SELECT, [
                'choices' => $fileType,
                'empty_value' => '=== Select File Type ===',
                'rules' => 'required',
            ])
            ->add('heading_line_number_from_sheet', Field::SELECT, [
                'choices' => $heading_lines,
                'empty_value' => '=== Select Heading Line Number ===',
                'rules' => 'required',
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }
}
