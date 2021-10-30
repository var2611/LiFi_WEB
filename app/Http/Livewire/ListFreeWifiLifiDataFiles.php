<?php

namespace App\Http\Livewire;

use App\Models\ImportLifiFreeWifiDataFile;
use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Actions\RedirectAction;
use LaravelViews\Facades\Header;
use LaravelViews\Facades\UI;
use LaravelViews\Views\TableView;

class ListFreeWifiLifiDataFiles extends TableView
{
    protected $paginate = 20;
    public $searchBy = ['name', 'date'];

    /** After */
//    protected $model = LeaveType::class;

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {

        return ImportLifiFreeWifiDataFile::query()->whereIsVisible(0)->orderByDesc('id');
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
            Header::title('Date')->sortBy('date'),
            Header::title('Download'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model ImportLifiFreeWifiDataFile model for each row
     */
    public function row(ImportLifiFreeWifiDataFile $model): array
    {
        return [
            $model->id,
            $model->name,
            $model->date,
            UI::link('Download',$model->url)
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
