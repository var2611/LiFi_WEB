<?php

namespace App\Http\Livewire;

use App\Filters\FilterDate;
use App\Models\ImportPublicWifiSeasonData;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Actions\RedirectAction;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class ListFreeWifiLifiDataFiles extends TableView
{
    public $searchBy = ['mobile', 'login_start_time'];
    protected $paginate = 100;

    /** After */
//    protected $model = LeaveType::class;

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        return ImportPublicWifiSeasonData::query();
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
            Header::title('Mobile')->sortBy('mobile'),
            Header::title('Time Spent')->sortBy('converted_session_time'),
            Header::title('Data Used')->sortBy('converted_total_data'),
            Header::title('Start Time')->sortBy('login_start_time'),
            Header::title('Stop Time')->sortBy('login_stop_time'),
//            Header::title('Download'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model ImportPublicWifiSeasonData model for each row
     */
    public function row(ImportPublicWifiSeasonData $model): array
    {
        return [
            $model->id,
            $model->mobile_with_isd_code,
            $model->converted_session_time,
            $model->converted_total_data,
            $model->login_start_time,
            $model->login_stop_time,
//            UI::link('Download',$model->url)
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

    protected function filters()
    {
        return [
            new FilterDate('login_start_time'),
        ];
    }
}
