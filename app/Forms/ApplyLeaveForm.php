<?php

namespace App\Forms;

use App\Models\FormModels\ApplyLeave;
use App\Models\LeaveType;
use Illuminate\Support\Arr;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class ApplyLeaveForm extends Form
{
    public function buildForm()
    {
        $data = LeaveType::get(['id', 'name'])->toArray();

        $this
            ->add('leave_type', Field::SELECT, [
                'choices' => Arr::pluck($data, 'name', 'id'),
//                'choices' => ['en' => 'English', 'fr' => 'French'],
//                'selected' => function ($data) {
//                    // Returns the array of short names from model relationship data
//                    return Arr::pluck($data, 'name');
//                },
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
                'rules' => 'required|min:2',
            ])
            ->add('reason', Field::TEXTAREA, [
                'rules' => 'required | max:400'
            ])->add('user_id', Field::HIDDEN, [
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }
}
