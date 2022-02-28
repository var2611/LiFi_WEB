<?php

namespace App\Forms\Export;

use App\Models\Salary;
use Illuminate\Support\Arr;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class ExportDownloadForm extends Form
{
    public function buildForm()
    {
        $salary_month = Salary::selectRaw("CONCAT(MONTHNAME(str_to_date(month,'%m')), ' ', year) as salary_month, month, year")->distinct()->orderBy('month')->get();

//        echo json_encode($salary_month) . '<br>';
//        dd($salary_month);

        $this
            ->add('selected_month', Field::SELECT, [
                'rules' => 'required',
                'choices' => Arr::pluck($salary_month, 'salary_month', 'salary_month'),
//                'choices' => ['en' => 'English', 'fr' => 'French'],
//                'selected' => function ($data) {
//                     Returns the array of short names from model relationship data
//                    return Arr::pluck($data, 'short_lang_name');
//                },
                'empty_value' => '=== Select Month ==='
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
            ]);
    }
}
