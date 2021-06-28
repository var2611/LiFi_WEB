<?php

namespace App\Forms;

use App\Models\LeaveType;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class ApplyLeaveForm extends Form
{
    public function buildForm()
    {
        $data = LeaveType::get(['id', 'name'])->toArray();

        $this
            ->add('leave_type', Field::SELECT, [
                'choices' => $data,
//                'choices' => ['en' => 'English', 'fr' => 'French'],
                'empty_value' => '=== Select Type ==='
            ])
            ->add('date_from', Field::DATE, [
                'rules' => 'required'
            ])
            ->add('date_to', Field::DATE, [
                'rules' => 'required'
            ])
            ->add('from_time', Field::TIME, [
                'rules' => 'required'
            ])
            ->add('to_time', Field::TIME, [
                'rules' => 'required'
            ])
            ->add('days', Field::TEXT, [
                'rules' => 'required'
            ])
            ->add('reason', Field::TEXTAREA, [
                'rules' => 'required | max:400'
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }
}
