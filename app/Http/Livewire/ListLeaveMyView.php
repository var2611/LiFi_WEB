<?php

namespace App\Http\Livewire;

use App\Models\EmployeeLeave;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Facades\Header;
use LaravelViews\Facades\UI;
use LaravelViews\Views\TableView;

class ListLeaveMyView extends TableView
{
    public $searchBy = ['user.name', 'user.mobile', 'emp_code'];

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        $data = EmployeeLeave::query();

        $data = $data->whereUserId(Auth::user()->id)->with(['user', 'leaveType']);

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
            Header::title('Leave Type'),
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
            $model->leaveType->name,
            $model->date_from . ' ' . $model->from_time,
            $model->date_to . ' ' . $model->to_time,
            $model->days,
            $model->status == 2 ? UI::badge('Rejected', 'warning') : ($model->status ? UI::badge('Approved', 'success') : UI::badge('Pending', 'danger')),
//            $model->remarks,
            $model->reason,
            $model->created_at,
        ];
    }
}
