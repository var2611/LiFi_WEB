<?php

namespace App\Http\Livewire;

use App\Actions\Bulk\SalaryAttendanceOvertimeModification;
use App\Models\Attendance;
use App\Models\Salary;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Views\ListView;

class ListAttendanceOvertimeCustomView extends ListView
{
    public $itemComponent = 'hrms.component.salary.data-attendance-overtime';
    /**
     * @var Salary
     */
    public $salary;
    /**
     * Sets a model class to get the initial data
     */
    public $model = Attendance::class;

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        $monthly_off_dates = getMonthlyOffDatesByCompany($this->salary);

        return Attendance::query()->whereUserId($this->salary->user_id)->whereMonth('date', $this->salary->month)->whereYear('date', $this->salary->year)->whereIn('date', $monthly_off_dates);
    }

    /**
     * Sets the properties to every list item component
     *
     * @param $model Attendance model for each card
     */
    public function data($model)
    {
        return [
            'avatar' => '',
            'title' => '',
            'subtitle' => '',
        ];
    }

    protected function bulkActions(){
        return [
            new SalaryAttendanceOvertimeModification
        ];
    }
}
