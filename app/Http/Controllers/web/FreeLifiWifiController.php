<?php

namespace App\Http\Controllers\web;

use App\Forms\UploadFreeLifiWifiFile;
use App\Http\Controllers\Controller;
use App\Http\Livewire\FreeWifiLifiDataFiles;
use App\Models\ImportLifiFreeWifiDataFile;
use App\Models\ImportParthSalarySheetData;
use Auth;
use LaravelViews\LaravelViews;
use Maatwebsite\Excel\Validators\ValidationException;

class FreeLifiWifiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index(LaravelViews $laravelViews)
    {
        $addButtonRoute = null;
        if (Auth::user()->isAdmin()) {

            $addButtonRoute = 'free-lifi-wifi-file-edit';

        }
        return $this->createList($laravelViews, FreeWifiLifiDataFiles::class, 'Free LiFI Wifi Data Usage files', 'employee', $addButtonRoute, false, 'main-list-no-side-menu');

    }

    public function freeLiFiWiFiFileCreate(string $id = null)
    {
        $model = new ImportLifiFreeWifiDataFile();
        return $this->createForm(null, UploadFreeLifiWifiFile::class, $model, route('free-lifi-wifi-file-store'), 'salary','layouts.hrms_forms_no_side_menu');
    }

    public function freeLiFiWiFiFileStore()
    {
        $model = new ImportParthSalarySheetData();
        $form = $this->form(UploadFreeLifiWifiFile::class);
        $form->redirectIfNotValid();
//        print_r($form->getFieldValues());
        if ($form->getRequest()->hasFile('upload_file')) {

            try {
                $file = $form->getRequest()->file('upload_file');
                $file_extension = get_file_extension($file);
                $upload_path = "/uploads/freewifilifi/";
                $file_name = $file->getClientOriginalName();
                $file_url = upload_file($upload_path, $file_name, $file);
                $model = new ImportLifiFreeWifiDataFile();
                $model->name = $file_name;
                $model->url = $file_url;
                $model->created_by = Auth::id();
                $model->updated_by = Auth::id();
                $model->date = $form->getRequest()->date;
                $model->save();
                if ($model) {
                    $this->notifyMessage(true, 'File uploaded successfully');
                    return redirect()->route('free-lifi-wifi-file-list');
                } else {
                    $this->notifyMessage(false, 'File could not be uploaded');
                }
            } catch (ValidationException $e) {
                $failures = $e->failures();
                echo json_encode($failures, JSON_PRETTY_PRINT);
            }
        } else {
            echo 'File not found';
        }
    }
}
