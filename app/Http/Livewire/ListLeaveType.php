<?php

namespace App\Http\Livewire;

use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Actions\RedirectAction;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class ListLeaveType extends TableView
{
    /** After */
//    protected $model = LeaveType::class;

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        return LeaveType::query()->whereIsVisible(0);
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
            Header::title('description'),
            Header::title('created at')->sortBy('created_at')
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model LeaveType model for each row
     */
    public function row(LeaveType $model): array
    {
        return [
            $model->id,
            $model->name,
            $model->description,
            $model->created_at,
        ];
    }

    /**
     * @return RedirectAction[]
     */
    protected function actionsByRow(): array
    {
        return [
            new RedirectAction('leave-type-edit', 'Edit Contract Amount Type', 'edit'),
        ];
    }
}
