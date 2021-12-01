<?php

namespace App\Http\Livewire;

use App\Models\EmpDepartmentData;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Actions\RedirectAction;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class ListEmployeeDepartmentType extends TableView
{
    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        return EmpDepartmentData::query();
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
            Header::title('created at')->sortBy('created_at')
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model EmpDepartmentData model for each row
     */
    public function row($model): array
    {
        return [
            $model->id,
            $model->name,
            $model->created_at,
        ];
    }

    /**
     * @return RedirectAction[]
     */
    protected function actionsByRow(): array
    {
        return [
            new RedirectAction('emp-department-type-edit', 'Edit Department Type', 'edit'),
        ];
    }
}
