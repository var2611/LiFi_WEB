<?php

namespace App\Http\Controllers\web;

use App\Exports\SalaryExport;
use App\Forms\Export\ExportAttendanceForm;
use App\Forms\Export\ExportSalarySlipForm;
use App\Http\Controllers\Controller;
use App\Models\FormModels\DataSalarySlip;
use App\Models\Salary;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use View;

class ExportController extends Controller
{
    public function sheetExportSalaryForm()
    {
        $form = $this->form(ExportSalarySlipForm::class, [
            'method' => 'POST',
            'url' => route('sheet-export-salary-download')
        ]);

        return view('layouts.hrms_forms', compact('form'), ['export' => true]);
    }

    public function sheetExportSalaryDownload()
    {
        $form = $this->form(ExportSalarySlipForm::class);

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
        $form = $this->form(ExportSalarySlipForm::class, [
            'method' => 'POST',
            'url' => route('pdf-export-salary-slip-download')
        ]);

        return view('layouts.hrms_forms', compact('form'), ['export' => true]);
    }

    public function pdfExportSalarySlipDownload()
    {
        $form = $this->form(ExportSalarySlipForm::class);

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
//            ->limit(3)
            ->get(['id', 'user_id', 'name', 'date', 'month', 'year','month_days','week_off_days', 'total_days', 'present_days', 'absent_days', 'salary_contract_basic', 'salary_contract_basic', 'salary_contract_basic','salary_basic', 'salary_hra', 'salary_total', 'salary_gross_earning', 'salary_gross_deduction', 'salary_net_pay']);

//        foreach ($salary as $sal) {
        $data_salary_slips = array();

        foreach ($salary as $sal) {
            $data_salary_slips[] = new DataSalarySlip($sal);

        }

        $view = 'hrms.component.export.salary-slip-hindi';

//        $viewTest = 'hrms.component.export.salary-slip-demo';
        $viewTest = 'hrms.component.export.salary-slip-hindi';
//        $dataTest = View::make($viewTest, ['data_salary_slips' => $data_salary_slips])->render();

        try {

            $dpdf = Pdf::loadView($view, ['data_salary_slips' => $data_salary_slips])->setPaper('a3');
            return $dpdf->download("$selected_month_year.pdf");
//        return $dataTest;
        } catch (\Exception $e) {
            echo $e;
        }


//        }

//        return $pdf->download('document.pdf');

    }

    public function pdfExportAttendanceForm()
    {
        $form = $this->form(ExportAttendanceForm::class, [
            'method' => 'POST',
            'url' => route('pdf-export-attendance-download')
        ]);

        return view('layouts.hrms_forms', compact('form'), ['export' => true]);
    }

    public function pdfExportAttendanceDownload()
    {
        $form = $this->form(ExportAttendanceForm::class);

        $form->redirectIfNotValid();

        // Do saving and other things...
        $formData = $form->getFieldValues();

        $selected_month_year = $formData['selected_month'];
        $date = strtotime($selected_month_year);
        $month = date('m', $date);
        $year = date('Y', $date);
        $companyId = Auth::user()->getCompanyId();

        $view = 'hrms.component.export.attendance-slip';
        try {

//            $dpdf = Pdf::loadHTML((new AttendanceController)->attendanceExportData($month, $year, $companyId))->setPaper('a4', 'landscape');
//            $dpdf = Pdf::loadView($view ,(new AttendanceController)->attendanceExportData($month, $year, $companyId))->setPaper('a3', 'landscape');

//            return $dpdf->download("Time_Sheet_of_$selected_month_year.pdf");
//        return $data;
        } catch (\Exception $e) {
            echo $e;
        }

        return view($view, (new AttendanceController)->attendanceExportData($month, $year, $companyId));
    }

}
