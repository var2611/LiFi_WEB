<?php

namespace App\Http\Livewire;

use App\Models\Attendance;
use App\Models\Salary;
use LaravelViews\Views\DetailView;

class DetailListSalaryView extends DetailView
{
    public $title = "Salary Details";
    public $subtitle = "Edit and Update salary data by monthly attendance";
    protected $detailComponent = 'hrms.component.salary.detail-salary';

    public function heading(Salary $model)
    {
        return [$model->name , getMonthNameFromMonthNumber($model->month) . ' ' . $model->year. ' salary details'];
    }

    /**
     * @param $model Salary instance
     * @return array Array with all the detail data or the components
     */
    public function detail($model): array
    {
        $monthly_off_dates = getMonthlyOffDatesByCompany($model);

        $attendances = Attendance::whereUserId($model->user_id)->whereMonth('date', $model->month)->whereYear('date', $model->year)->whereIn('date', $monthly_off_dates)->get();

        return [
            'salary' => $model,
            'attendances' => $attendances,
        ];
    }
}
