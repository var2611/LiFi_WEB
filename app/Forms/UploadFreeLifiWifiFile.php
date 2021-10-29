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
                'wrapper' => ['class' => 'col-sm-4'],
                'attr' => ['accept' => '.xls,.xlsx,.csv'],
                'rules' => 'required',
            ])
            ->add('date', Field::DATE, [
                'wrapper' => ['class' => 'col-sm-4'],
                'rules' => 'required'
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
                'wrapper' => ['class' => 'col-sm-3 mt-3'],
            ]);
    }
}
