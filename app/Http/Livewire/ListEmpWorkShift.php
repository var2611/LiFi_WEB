<?php

namespace App\Http\Livewire;

use App\Models\EmpWorkShift;
use Auth;
use LaravelViews\Facades\Header;
use LaravelViews\Facades\UI;
use LaravelViews\Views\TableView;
use Illuminate\Database\Eloquent\Builder;

class ListEmpWorkShift extends TableView
{
    public $searchBy = ['name', 'date'];
    protected $paginate = 20;

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        return EmpWorkShift::query()->whereIsVisible(0);
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title('Name')->sortBy('name'),
            Header::title('Description'),
            Header::title('start_time'),
            Header::title('end_time'),
            Header::title('hours'),
            Header::title('mon'),
            Header::title('tue'),
            Header::title('wed'),
            Header::title('thur'),
            Header::title('fri'),
            Header::title('sat'),
            Header::title('sun'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model EmpWorkShift model for each row
     */
    public function row($model): array
    {
        return [
            $model->name,
            $model->description,
            $model->start_time,
            $model->end_time,
            $model->hours,
            $model->mon == 0 ? UI::badge('Working', 'success') : UI::badge('Holiday', 'danger'),
            $model->tue,
            $model->wed,
            $model->thur,
            $model->fri,
            $model->sat,
            $model->sun,
        ];
    }
}
