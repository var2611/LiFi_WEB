<?php

namespace App\Http\Controllers\web;

use App\Forms\Import\ImportLatLongDataForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\ListLatLongInternetDataView;
use App\Imports\ImportLatLongInternetData;
use App\Imports\ImportLatLongNonInternetData;
use Auth;
use DB;
use LaravelViews\LaravelViews;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class LatLongInternetController extends Controller
{
    public function test()
    {

        $data = DB::raw("SELECT (SELECT internet.name, ST_Distance_Sphere(
                            ST_GeomFromText(
                                   CONCAT('POINT(',
                                          CONCAT(internet.longitude, ' ',
                                                 internet.latitude), ')'), 4326),
                           ST_GeomFromText(
                                   CONCAT('POINT(',
                                          CONCAT(internet_non.longitude, ' ',
                                                 internet_non.latitude), ')'), 4326)) /
                   1000 as dis
                            FROM import_lat_long_internet_data as internet  order by dis limit 1) as min_data
                            FROM import_lat_long_non_internet_data as internet_non");

        echo json_encode($data) . '<br>';
        dd($data);

    }

    public function createImportDataForm()
    {
        $form = $this->form(ImportLatLongDataForm::class, [
            'method' => 'POST',
            'url' => route('generate-lat-long-data')
        ]);

        return view('layouts.hrms_forms', compact('form'), ['import' => true]);
    }

    public function saveLatLongDataToDatabase(): string
    {
        $form = $this->form(ImportLatLongDataForm::class);
        $form->redirectIfNotValid();
        $formData = $this->formStoreData(ImportLatLongDataForm::class);

        $heading_line_number_from_sheet = $formData['heading_line_number_from_sheet'];
        $file_type = $formData['file_type'];

        if ($form->getRequest()->hasFile('import_lat_long_sheet')) {
            try {

                $file = $form->getRequest()->file('import_lat_long_sheet');

                if ($file_type == '01') {
                    $importEmpContracts = Excel::import(new ImportLatLongInternetData($heading_line_number_from_sheet, Auth::user()->getCompanyId()), $file);
                } elseif ($file_type == '02') {
                    $importEmpContracts = Excel::import(new ImportLatLongNonInternetData($heading_line_number_from_sheet, Auth::user()->getCompanyId()), $file);
                }
                return 'aaa';
            } catch (ValidationException $e) {
                $failures = $e->failures();

                return json_encode($failures, JSON_PRETTY_PRINT);
            }

        } else {
            return 'File Not Found';
        }
        return 'Saved';
    }

    public function listLatLongNonInternetData(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, ListLatLongInternetDataView::class, 'Lat-Long Non Internet Data', 'import');
    }
}
