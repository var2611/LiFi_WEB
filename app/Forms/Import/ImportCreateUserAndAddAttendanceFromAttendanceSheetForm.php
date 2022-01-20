<?php

namespace App\Forms\Import;

use Illuminate\Support\Arr;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class ImportCreateUserAndAddAttendanceFromAttendanceSheetForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('employees_attendance_sheet', Field::FILE, [
                'attr' => ['accept' => '.xlsx'],
                'rules' => 'required',
            ])->add('attendance_month', Field::SELECT, [
                'choices' => getMonthListArray(),
                'empty_value' => '=== Select Month ===',
                'rules' => 'required',
            ])->add('attendance_year', Field::SELECT, [
                'choices' => getYearListArray(),
                'empty_value' => '=== Select Year ===',
                'rules' => 'required',
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }
}
