<?php

namespace App\Http\Livewire;

use App\Models\AttendanceData;
use App\Models\UserEmployee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class AttendanceTableView extends TableView
{
    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        $user = Auth::user();
        $company_id = UserEmployee::whereUserId($user->id)->first()->company_id;
        $data = AttendanceData::query();
//        if ($company_id != 1) {
            $data = $data->whereCompanyId($company_id);
//        }
        return $data->orderByDesc('attendance_id');
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title('ID')->sortBy('attendance_id'),
            Header::title('Employee Code')->sortBy('emp_code'),
            Header::title('Name'),
            Header::title('Date'),
            Header::title('In Time')->sortBy('in_time'),
            Header::title('Out Time'),
            Header::title('Hours Worked'),
            Header::title('Status')->sortBy('status'),
            Header::title('Created at')->sortBy('created_at'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model AttendanceData model for each row
     */
    public function row($model): array
    {
        $hours_worked = 0;

        if ($model->hours_worked) {
            $hours_worked = number_format((float)$model->hours_worked, 2, '.', '');
        } else {
            $hours_worked = Carbon::parse($model->in_time)->shortAbsoluteDiffForHumans();
        }

        return [
            $model->attendance_id,
            $model->emp_code,
            $model->user_name,
            $model->date,
            $model->in_time,
            $model->out_time,
            $hours_worked . ' H',
            $model->status,
            $model->created_at
        ];
    }
}
