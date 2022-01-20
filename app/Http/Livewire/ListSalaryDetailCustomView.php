<?php

namespace App\Http\Livewire;

use App\Models\SalaryDetail;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Views\ListView;

class ListSalaryDetailCustomView extends ListView
{
    public $itemComponent = 'hrms.component.salary.salary-earning-data';
    public $salary_id;
    /**
     * Sets a model class to get the initial data
     */
    protected $model = SalaryDetail::class;

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        return SalaryDetail::query()->whereSalaryId($this->salary_id);
    }

    /**
     * Sets the properties to every list item component
     *
     * @param $model SalaryDetail model for each card
     */
    public function data($model)
    {
        return [
            'avatar' => '',
            'title' => '',
            'subtitle' => '',
        ];
    }
}
