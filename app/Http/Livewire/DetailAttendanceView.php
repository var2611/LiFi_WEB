<?php

namespace App\Http\Livewire;

use App\Models\AttendanceData;
use Carbon\Carbon;
use LaravelViews\Views\DetailView;

class DetailAttendanceView extends DetailView
{
    public $title = "Title";
    public $subtitle = "Subtitle or description";

    protected $modelClass = AttendanceData::class;

    /**
     * @param $model AttendanceData instance
     * @return array Array with all the detail data or the components
     */
    public function detail($model): array
    {
        $this->title = $model->user_name;
        $this->subtitle = $model->role_name;

        return [
            'Employee Code' => $model->emp_code,
            'Mobile' => $model->mobile,
            'Registration Date' => $model->user_registered_at . " : " . Carbon::parse($model->user_registered_at)->diffForHumans(),
        ];
    }
}
