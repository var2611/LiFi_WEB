<?php

namespace App\Forms\Export;

use App\Models\Attendance;
use Auth;
use Illuminate\Support\Arr;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class ExportAttendanceForm extends Form
{
    public function buildForm()
    {
        $companyId = Auth::user()->getCompanyId();

        $attendanceMonth = Attendance::selectRaw(
            "CONCAT(MONTHNAME(date), ' ', YEAR(date)) as salary_month, MONTH(date) as month, YEAR(date) as year")
            ->distinct()
            ->with(['User.UserEmployee:id,user_id,company_id'])
            ->whereHas('User.UserEmployee', function ($q) use ($companyId) {
                $q->where('company_id', '=', $companyId);
            })
            ->orderBy('date')
            ->get();

//        echo json_encode($salary_month) . '<br>';
//        dd($salary_month);

        $this
            ->add('selected_month', Field::SELECT, [
                'rules' => 'required',
                'choices' => Arr::pluck($attendanceMonth, 'salary_month', 'salary_month'),
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
