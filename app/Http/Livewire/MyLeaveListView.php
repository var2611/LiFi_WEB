<?php

namespace App\Http\Livewire;

use App\Models\EmployeeLeaves;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class MyLeaveListView extends TableView
{
    public $searchBy = ['user.name', 'user.mobile', 'emp_code'];

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        $data = EmployeeLeaves::query();

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
            Header::title('Remarks'),
            Header::title('Reason'),
            Header::title('Created At'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model EmployeeLeaves model for each row
     */
    public function row($model): array
    {
        return [
            $model->leaveType->name,
            $model->date_from . ' ' . $model->from_time,
            $model->date_to . ' ' . $model->to_time,
            $model->days,
            $model->status,
            $model->remarks,
            $model->reason,
            $model->created_at,
        ];
    }
}
