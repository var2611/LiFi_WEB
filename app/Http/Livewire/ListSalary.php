<?php

namespace App\Http\Livewire;

use App\Models\Salary;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Actions\RedirectAction;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class ListSalary extends TableView
{
    public $searchBy = ['UserEmployee.emp_code', 'User.name', 'user_id'];
    protected $paginate = 100;

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        $company_id = Auth::user()->getCompanyId();

        $data = Salary::query()
//            ->select(['id', 'month', 'year', 'present_days', 'absent_days', 'total_days', 'salary_basic', 'salary_hra', 'salary_gross_deduction', 'salary_gross_earning', 'salary_net_pay'])
            ->whereIsVisible(0)
            ->with(['User', 'UserEmployee'])->orderByDesc('id');

        if ($company_id != 1) {
            $data->whereHas('UserEmployee', function ($q) use ($company_id) {
                $q->where('company_id', '=', $company_id);
//                $q->where('user_id', '=', 'users.id');
            });
        }
        return $data;
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
//            Header::title('No')->sortBy('id'),
            Header::title('Emp Code')->sortBy('UserEmployee.emp_code'),
            Header::title('Month'),
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
//            $model->id,
            $model->UserEmployee->emp_code,
            getMonthNameFromMonthNumber($model->month) . ' ' . $model->year,
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
            new RedirectAction('salary-slip', 'See Attendance Detail', 'eye'),
            new RedirectAction('salary-edit', 'See Attendance Detail', 'edit'),
        ];
    }
}
