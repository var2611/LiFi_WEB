<?php

namespace App\Http\Livewire;

use App\Filters\SelectionFilter;
use App\Models\ImportLatLongInternetData;
use App\Models\ImportLatLongNonInternetData;
use Arr;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class ListLatLongInternetDataView extends TableView
{
    public $searchBy = ['district'];
    protected $paginate = 20;

    /**
     * Sets a model class to get the initial data
     */
    protected $model = ImportLatLongNonInternetData::class;

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title('Group ID')->sortBy('group_id'),
            Header::title('Name')->sortBy('name'),
            Header::title('Lat-Long'),
            Header::title('File Name')->sortBy('file_name'),
            Header::title('Distance'),
            Header::title('Group ID'),
            Header::title('Name'),
            Header::title('Lat-Long'),
            Header::title('File Name'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model ImportLatLongNonInternetData model for each row
     * @return array
     */
    public function row($model): array
    {
        $nearData = ImportLatLongInternetData::select(['*'])
            ->selectSub("(ST_Distance_Sphere(
                ST_GeomFromText(
                        CONCAT('POINT(',
                               CONCAT(import_lat_long_internet_data.longitude, ' ',
                                      import_lat_long_internet_data.latitude), ')'), 4326),
                ST_GeomFromText(
                        CONCAT('POINT(',
                               CONCAT($model->longitude, ' ',
                                      $model->latitude), ')'), 4326)) /
        1000)", 'distance')
            ->orderBy('distance')
            ->first();

//        dd($nearData);
        return [
            $model->group_id,
            $model->name,
            $model->latitude . ', ' . $model->longitude,
            $model->file_name,
            $nearData->distance,
            $nearData->group_id,
            $nearData->name,
            $nearData->latitude . ', ' . $nearData->longitude,
            $nearData->file_name,

        ];
    }

    protected function filters()
    {
        $stateNames = ImportLatLongNonInternetData::distinct()->get(['state'])->toArray();
        $districtNames = ImportLatLongNonInternetData::distinct()->get(['district'])->toArray();
        $zoneNames = ImportLatLongNonInternetData::distinct()->get(['zone'])->toArray();

//        dd(Arr::pluck($districtNames, 'district', 'district'));
        return [
            new SelectionFilter('State','state', Arr::pluck($stateNames, 'state', 'state')),
            new SelectionFilter('District','district', Arr::pluck($districtNames, 'district', 'district')),
            new SelectionFilter('Zone','zone', Arr::pluck($zoneNames, 'zone', 'zone')),
        ];
    }
}
