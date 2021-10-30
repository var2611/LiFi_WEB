<?php

namespace App\Http\Livewire;

use App\Models\Holiday;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Actions\RedirectAction;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class ListHoliday extends TableView
{
    public $searchBy = ['name', 'date'];
    protected $paginate = 20;

    /** After */
//    protected $model = LeaveType::class;

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {

        return Holiday::query()->whereCompanyId(Auth::user()->getCompanyId())->whereIsVisible(0);
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title('No')->sortBy('id'),
            Header::title('Name')->sortBy('name'),
            Header::title('Description'),
            Header::title('Date')->sortBy('date'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Holiday model for each row
     */
    public function row(Holiday $model): array
    {
        return [
            $model->id,
            $model->name,
            $model->description,
            $model->date,
        ];
    }

    /**
     * @return RedirectAction[]
     */
    protected function actionsByRow(): array
    {
        return [
            // new RedirectAction('leave-type-edit', 'Edit Contract Amount Type', 'download'),
        ];
    }
}
