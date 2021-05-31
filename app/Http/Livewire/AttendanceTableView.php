<?php

namespace App\Http\Livewire;

use App\Models\Attendance;
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
        return Attendance::query()
            ->with(['User.UserEmployee'])
            ->orderByDesc('created_by');
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title('Employee Code'),
            Header::title('Name'),
            Header::title('Date'),
            Header::title('in_time'),
            Header::title('out_time'),
            Header::title('hours_worked'),
            Header::title('status'),
            Header::title('created at')->sortBy('created_at'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Attendance model for each row
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
            $model->user->userEmployee->emp_code,
            $model->name,
            $model->date,
            $model->in_time,
            $model->out_time,
            $hours_worked . ' H',
            $model->status,
            $model->created_at->diffForHumans()
        ];
    }
}
