<?php

namespace App\Http\Controllers\web;

use App\Exports\SalaryExport;
use App\Forms\Export\ExportDownloadForm;
use App\Http\Controllers\Controller;
use App\Models\FormModels\DataSalarySlip;
use App\Models\Salary;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Exception;

class ExportController extends Controller
{
    public function sheetExportSalaryForm()
    {
        $form = $this->form(ExportDownloadForm::class, [
            'method' => 'POST',
            'url' => route('sheet-export-salary-download')
        ]);

        return view('layouts.hrms_forms', compact('form'), ['export' => true]);
    }

    public function sheetExportSalaryDownload()
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

    public function pdfExportSalarySlipForm()
    {
        $form = $this->form(ExportDownloadForm::class, [
            'method' => 'POST',
            'url' => route('pdf-export-salary-slip-download')
        ]);

        return view('layouts.hrms_forms', compact('form'), ['export' => true]);
    }

    public function pdfExportSalarySlipDownload()
    {
        $form = $this->form(ExportDownloadForm::class);

        $form->redirectIfNotValid();

        // Do saving and other things...
        $formData = $form->getFieldValues();

        $selected_month_year = $formData['selected_month'];
        $date = strtotime($selected_month_year);
        $month = date('m', $date);
        $year = date('Y', $date);

        $salary = Salary::with(['UserEmployee:id,user_id,emp_code', 'UserEmployee.EmpDepartmentData:id,user_id,emp_department_type_id,description', 'UserEmployee.EmpDepartmentData.EmpDepartmentType:id,name', 'UserEmployee.EmpPfDetail:id,user_id,pf_number,uan,bank_name,description,status'])
            ->where('month', $month)
            ->where('year', $year)
            ->get(['id', 'user_id', 'name', 'date', 'month', 'year', 'total_days', 'present_days', 'absent_days', 'salary_basic', 'salary_hra', 'salary_total', 'salary_gross_earning', 'salary_gross_deduction', 'salary_net_pay']);

//        foreach ($salary as $sal) {
        $data_salary_slips = array();

        foreach ($salary as $sal) {
            $data_salary_slips[] = new DataSalarySlip($sal);

        }
//        $pdf = PDF::getPdf();
//        $mpdf = $pdf->getMpdf();
        // get instance
//        $pdf->stream();
//        $view = 'layouts.salary-slip';
        $view = 'layouts.salary-slip-demo';
//        $data = View::make($view, ['data_salary_slips' => $data_salary_slips])->render();


        try {

//            $pdf = new LaravelMpdf();
//            $pdf->getMpdf()->WriteHTML($data);

            $dpdf = Pdf::loadView($view, ['data_salary_slips' => $data_salary_slips]);
//            $dpdf = Pdf::loadHTML($data);
//            $dpdf->render();
//
//            $dpdf->getDomPDF()
//                ->getOptions()
//                ->setIsRemoteEnabled(true);
//            $pdf = PDF::loadView($view, ['data_salary_slips' => $data_salary_slips]);
//            $pdf->getMpdf()->WriteHTML($stylesheet1, HTMLParserMode::HEADER_CSS);
//            $pdf->getMpdf()->WriteHTML($stylesheet2, HTMLParserMode::HEADER_CSS);
//            $pdf->getMpdf()->WriteHTML($data, HTMLParserMode::DEFAULT_MODE);

            return $dpdf->download();
//        return $data;
        } catch (\Exception $e) {
            echo $e;
        }


//        }

//        return $pdf->download('document.pdf');

    }
}
