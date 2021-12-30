<?php

namespace App\Http\Controllers\web;

use App\Exports\SalaryExport;
use App\Forms\Export\ExportDownloadForm;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Exception;

class ExportController extends Controller
{
    public function index()
    {
        $form = $this->form(ExportDownloadForm::class, [
            'method' => 'POST',
            'url' => route('generate-export-download')
        ]);

        return view('layouts.hrms_forms', compact('form'));
    }

    public function exportData()
    {
        $form = $this->form(ExportDownloadForm::class);

        $form->redirectIfNotValid();

        // Do saving and other things...
        $formData = $form->getFieldValues();

        $selected_month_year = $formData['selected_month'];
        $date = strtotime($selected_month_year);
        $month = date('m', $date);
        $year = date('Y', $date);

        try {
            return Excel::download(new SalaryExport($year, $month), "$selected_month_year.xlsx");
        } catch (Exception|\PhpOffice\PhpSpreadsheet\Exception $e) {
            dd($e);
        }

        dd($month . '  ' . $year);

//        return redirect()->route('report-export-download');
    }
}
