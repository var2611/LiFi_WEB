<?php

namespace App\Http\Livewire;

use App\Models\SalaryAllowanceType;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Actions\RedirectAction;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class ListSalaryAllowanceType extends TableView
{
    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        return SalaryAllowanceType::query()->whereIsVisible(0);
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
     * @param $model SalaryAllowanceType model for each row
     */
    public function row(SalaryAllowanceType $model): array
    {
        return [
            $model->id,
            $model->name,
            $model->created_at,
        ];
    }

    protected function actionsByRow(): array
    {
        return [
            new RedirectAction("edit-salary-allowance-type", 'Edit Salary Allowance Type', 'edit'),
        ];
    }
}
