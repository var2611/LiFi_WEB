<?php

namespace App\Http\Livewire;

use App\Models\Salary;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Actions\RedirectAction;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class ListSalary extends TableView
{
    public $searchBy = ['UserEmployee.emp_code', 'emp_code'];
    protected $paginate = 20;

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        return Salary::query()->whereIsVisible(0)->with(['User', 'UserEmployee']);
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title('No')->sortBy('id'),
            Header::title('Employee Code')->sortBy('UserEmployee.emp_code'),
            Header::title('Name')->sortBy('User.name'),
            Header::title('Present'),
            Header::title('Absent'),
            Header::title('Total Days'),
            Header::title('Basic'),
            Header::title('HRA'),
            Header::title('Gross Deduction'),
            Header::title('Gross Earning'),
            Header::title('Net Pay'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Salary model for each row
     */
    public function row(Salary $model): array
    {
        return [
            $model->id,
            $model->UserEmployee->emp_code,
            $model->UserEmployee->User->name,
            $model->present_days,
            $model->absent_days,
            $model->total_days,
            $model->salary_basic,
            $model->salary_hra,
            $model->salary_gross_deduction,
            $model->salary_gross_earning,
            $model->salary_net_pay,
        ];
    }

    protected function actionsByRow(): array
    {
        return [
            new RedirectAction('salary-view', 'See Attendance Detail', 'eye'),
        ];
    }
}
