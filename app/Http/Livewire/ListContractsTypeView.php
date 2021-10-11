<?php

namespace App\Http\Livewire;

use App\Models\EmpContract;
use App\Models\EmpContractType;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Actions\RedirectAction;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class ListContractsTypeView extends TableView
{
    public $searchBy = ['name'];
    protected $paginate = 20;

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        return EmpContractType::query();
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title('Name'),
            Header::title('Description'),
            Header::title('Date'),
            Header::title('Start Date'),
            Header::title('End Date'),
            Header::title('Working Hours'),
            Header::title('Contract Name'),
            Header::title('Shift Name'),
            Header::title('Created At')->sortBy('created_at')
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model EmpContractType model for each row
     */
    public function row(EmpContractType $model): array
    {
        return [
            $model->name,
            $model->description,
            $model->date,
            $model->start_date,
            $model->end_date,
            $model->working_hours,
            $model->EmpContractStatus->name,
            $model->EmpWorkShift->name,
            $model->created_at->diffForHumans()
        ];
    }

    /**
     * @return RedirectAction[]
     */
    protected function actionsByRow(): array
    {
        return [
            new RedirectAction("edit-user-profile", 'See user', 'edit'),
        ];
    }
}
