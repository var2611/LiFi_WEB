<?php

namespace App\Http\Livewire;

use App\Models\AttendanceData;
use LaravelViews\Views\DetailView;

class AttendanceDetailView extends DetailView
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
        return [
            'Name' => $model->user_name,
            'Mobile' => $model->mobile,
        ];
    }
}
