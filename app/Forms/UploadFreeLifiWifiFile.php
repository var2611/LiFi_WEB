<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class UploadFreeLifiWifiFile extends Form
{
    public function buildForm()
    {
        $this
            ->add('upload_file', Field::FILE, [
                'attr' => ['accept' => '.xls,.xlsx,.csv'],
                'rules' => 'required',
            ])
            ->add('date', Field::DATE, [
                'rules' => 'required'
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }
}
