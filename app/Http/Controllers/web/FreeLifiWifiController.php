<?php

namespace App\Http\Controllers\web;

use App\Forms\UploadFreeLifiWifiFileForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\ListFreeWifiLifiDataFiles;
use App\Models\ImportLifiFreeWifiDataFile;
use App\Models\ImportPublicWifiSeasonData;
use Auth;
use DB;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SetCookie;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Storage;
use LaravelViews\LaravelViews;

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

            $addButtonRoute = 'edit-free-lifi-wifi-file';

        }

//        $additional_data['total_season'] = ImportPublicWifiSeasonData::get()->count();
//        $additional_data['last_day_season'] = ImportPublicWifiSeasonData::whereDate('login_start_time', getYesterdayDate())->get()->count();
//        $additional_data['total_users'] = ImportPublicWifiSeasonData::distinct()->get('mobile')->count();
//        $additional_data['last_day_users'] = ImportPublicWifiSeasonData::whereDate('login_start_time', getYesterdayDate())->distinct()->get('mobile')->count();
//        $additional_data['total_download_data'] = (ImportPublicWifiSeasonData::sum('download_data')) / 1024 / 1024 / 1024;
//        $additional_data['last_day_download_data'] = (ImportPublicWifiSeasonData::whereDate('login_start_time', getYesterdayDate())->sum('download_data')) / 1024 / 1024 / 1024;
//        $additional_data['total_usage_time'] = (ImportPublicWifiSeasonData::sum('session_time')) / 60 / 60;
//        $additional_data['last_day_usage_time'] = (ImportPublicWifiSeasonData::whereDate('login_start_time', getYesterdayDate())->sum('session_time')) / 60 / 60;

        $additional_data = DB::select("select count(id)                                              as 'total_season',
       (select count(id)
        from import_public_wifi_season_data
        where date(login_start_time) = subdate(curdate(), 1)) as 'last_day_season',
       count(DISTINCT mobile)                                 as 'total_users',
       (select count(DISTINCT mobile)
        from import_public_wifi_season_data
        where date(login_start_time) = subdate(curdate(), 1)) as 'last_day_users',
       round(sum(total_data) / 1024 / 1024 / 1024)         as 'total_download_data',
       (select round(sum(total_data) / 1024 / 1024 / 1024)
        from import_public_wifi_season_data
        where date(login_start_time) = subdate(curdate(), 1)) as 'last_day_download_data',
       round(sum(session_time) / 60 / 60)                     as 'total_usage_time',
       (select round(sum(session_time) / 60 / 60)
        from import_public_wifi_season_data
        where date(login_start_time) = subdate(curdate(), 1)) as 'last_day_usage_time'
from import_public_wifi_season_data;");

//        echo json_encode($additional_data);
        return $this->createList($laravelViews, ListFreeWifiLifiDataFiles::class, 'Free LiFI Wifi Data Usage files', 'employee', $addButtonRoute, false, 'main-list-no-side-menu', $additional_data[0]);

    }

    public function freeLiFiWiFiFileCreate(string $id = null)
    {
        $model = new ImportLifiFreeWifiDataFile();
        return $this->createForm(null, UploadFreeLifiWifiFileForm::class, $model, route('store-free-lifi-wifi-file'), 'salary', 'layouts.hrms_forms_no_side_menu');
    }

    public function freeLiFiWiFiFileStore()
    {
        $model = new ImportPublicWifiSeasonData();
        $form = $this->form(UploadFreeLifiWifiFileForm::class);
        $form->redirectIfNotValid();
//        print_r($form->getFieldValues());
        if ($form->getRequest()->hasFile('upload_file')) {

            try {
//                $file = $form->getRequest()->file('upload_file');
//                $file_extension = get_file_extension($file);
//                $upload_path = "/uploads/freewifilifi/";
//                $file_name = $file->getClientOriginalName();
//                $file_url = upload_file($upload_path, $file_name, $file);
//                ------------------------------------------------------
//                $model = new ImportLifiFreeWifiDataFile();
//                $model->name = $file_name;
//                $model->url = $file_url;
//                $model->created_by = Auth::id();
//                $model->updated_by = Auth::id();
//                $model->date = $form->getRequest()->date;
//                $model->save();
//                if ($model) {
//                    $this->notifyMessage(true, 'File uploaded successfully');
//                    return redirect()->route('list-free-lifi-wifi-file');
//                } else {
//                    $this->notifyMessage(false, 'File could not be uploaded');
//                }
//---------------------------------------------------------------------------
//                $upload_dir = public_path() . '/uploads/freewifilifi/';
//                $file_dir_with_name = $upload_dir . $file_name;
//                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Ods();
//                $spreadsheet = $reader->load($file_dir_with_name);
//                $spreadsheet = IOFactory::load($file_dir_with_name);
//                $writer = new Xlsx($spreadsheet);
//                $writer->save($upload_dir);
//
//                $import = Excel::import(new ImportLifiFreeWifiDataFile(), $upload_dir . $file_name . '.xlsx', null, \Maatwebsite\Excel\Excel::XLSX);

            } catch (Exception $e) {
                $failures = $e->getMessage();
                echo json_encode($failures, JSON_PRETTY_PRINT);
            }
        } else {
            echo 'File not found';
        }
    }

    public function fetchPublicWiFiData()
    {
        $url = 'https://portal.freegwifi.com/reports/processLoginReport';
//        $urlHost = parse_url($url, PHP_URL_HOST);
//        $cookie_value = Storage::disk('public')->get('public_wifi_login.json');
        $cookies = [
//            new SetCookie([
//                'Name' => 'PHPSESSID',
//                'Value' => json_decode($cookie_value, true)['value'],
//
//                // Other attributes will not be sent to the server, they are only needed for validation.
//                'Domain' => 'portal.freegwifi.com',
//                'Path' => '/',
//            ]),
            new SetCookie([
                'Name' => 'cemail',
                'Value' => '$2y$10$M3vzcEDhkS2znmpGg5w.MuQlw0TFJ3wvlC.GzIh6dcSDjcGzSgwFi',

                // Other attributes will not be sent to the server, they are only needed for validation.
                'Domain' => 'portal.freegwifi.com',
                'Path' => '/',
            ]),

        ];

        $cookieJar = new CookieJar(true, $cookies);

        $httpClient = new Client();
        $response = $httpClient->post(
            $url,
            [
                RequestOptions::COOKIES => $cookieJar,
            ]
        );

        $cookie = $cookieJar->getCookieByName('PHPSESSID');

        $cookie_value = ['value' => $cookie->getValue()];
        Storage::disk('public')->put('public_wifi_login.json', json_encode($cookie_value));

        $cookieJar->setCookie($cookie);
        $this->savePublicWiFiData($cookieJar);

    }

    private function savePublicWiFiData($cookieJar)
    {

        $url = 'https://portal.freegwifi.com/reports/processLoginReport';

        $httpClient = new Client();
        $response = $httpClient->post(
            $url,
            [
                RequestOptions::COOKIES => $cookieJar,
                RequestOptions::HEADERS => [
                    'Accept' => 'application/json',
                ],
                RequestOptions::FORM_PARAMS => [
                    'loc_id[]' => '100711',
                    'from_date' => '2021-01-01',
                    'to_date' => '2021-12-31'
                ],
            ]
        );

        $data = array_values(json_decode($response->getBody()->getContents(), true));

        if (json_last_error() === JSON_ERROR_NONE && !empty($data)) {

            $status = $data[0];

            if ($status == 1) {

                $season_data = $data[1];
//                print_r($season_data);
                DB::statement('TRUNCATE import_public_wifi_season_data');
                echo insertOrUpdate('import_public_wifi_season_data', $season_data);
            }
        }
    }
}
