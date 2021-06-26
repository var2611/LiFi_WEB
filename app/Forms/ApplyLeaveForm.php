<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class ApplyLeaveForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('leave_type', Field::TEXT, [
                'rules' => 'required'
            ])
            ->add('date_from', Field::DATE, [
                'rules' => 'required'
            ])
            ->add('date_to', Field::DATE, [
                'rules' => 'required'
            ])
            ->add('time_from', Field::TIME, [
                'rules' => 'required'
            ])
            ->add('time_to', Field::TIME, [
                'rules' => 'required'
            ])
            ->add('days', Field::TEXT, [
                'rules' => 'required'
            ])
            ->add('reason', Field::TEXTAREA, [
                'rules' => 'required | max:400'
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ])
        ;
    }
}
