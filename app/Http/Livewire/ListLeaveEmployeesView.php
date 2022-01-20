<?php

namespace App\Http\Livewire;

use App\Actions\LeaveApproveAction;
use App\Actions\LeaveRejectAction;
use App\Filters\FilterDate;
use App\Models\EmployeeLeave;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use LaravelViews\Facades\Header;
use LaravelViews\Facades\UI;
use LaravelViews\Views\TableView;

class ListLeaveEmployeesView extends TableView
{
    public $searchBy = ['user.name', 'user.last_name', 'user.middle_name', 'user.mobile', 'userEmployee.emp_code', 'leaveType.name'];

    protected $model = EmployeeLeave::class;

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        $company_id = Auth::user()->getCompanyId();
        $data = EmployeeLeave::query();

        $data = $data->with(['User', 'UserEmployee', 'LeaveType']);

        if ($company_id != 4) {
            $data->whereHas('UserEmployee', function ($q) use ($company_id) {
                $q->where('company_id', '=', $company_id);
//                $q->where('user_id', '=', 'users.id');
            });
//            $data = $data->whereCompanyId($company_id);
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
            Header::title('id'),
            Header::title('Leave Type'),
            Header::title('Emp Code'),
            Header::title('Name'),
            Header::title('From'),
            Header::title('To'),
            Header::title('Days'),
            Header::title('Status'),
//            Header::title('Remarks'),
            Header::title('Reason'),
            Header::title('Created At'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model EmployeeLeave model for each row
     */
    public function row($model): array
    {
        return [
            $model->id,
            $model->leaveType->name,
            $model->userEmployee->emp_code,
            $model->user->name . $model->user->middle_name ?? ' ' . $model->user->last_name,
            $model->date_from . ' ' . $model->from_time,
            $model->date_to . ' ' . $model->to_time,
            $model->days,
            $model->status == 2 ? UI::badge('Rejected', 'warning') : ($model->status ? UI::badge('Approved', 'success') : UI::badge('Pending', 'danger')),
//            $model->remarks,
            $model->reason,
            $model->created_at,
        ];
    }

    protected function filters()
    {
        return [
            new FilterDate('date'),
        ];
    }

    protected function actionsByRow(): array
    {
        return [
            new LeaveRejectAction,
            new LeaveApproveAction,
        ];
    }
}
