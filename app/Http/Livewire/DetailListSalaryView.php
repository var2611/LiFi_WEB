<?php

namespace App\Http\Livewire;

use App\Actions\Bulk\SalaryAttendanceOvertimeModification;
use App\Models\Attendance;
use App\Models\Salary;
use App\Models\SalaryDetail;
use LaravelViews\Views\DetailView;

class DetailListSalaryView extends DetailView
{
    protected $detailComponent = 'hrms.component.salary.detail-salary';

    public function heading(Salary $model): array
    {
        return [$model->name . '(' . $model->UserEmployee->emp_code . ')' , getMonthNameFromMonthNumber($model->month) . ' ' . $model->year. ' salary details'];
    }

    /**
     * @param $model Salary instance
     * @return array Array with all the detail data or the components
     */
    public function detail($model): array
    {

        return [
            'salary' => $model,
            'salary_detail_class' => ListSalaryDetailCustomView::getName(),
            'attendance_overtime_class' => ListAttendanceOvertimeCustomView::getName(),
        ];
    }
}
