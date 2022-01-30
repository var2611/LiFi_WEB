<?php

namespace App\Http\Controllers\web;

use App\Forms\Import\ImportCreateUserAndAddAttendanceFromAttendanceSheetForm;
use App\Forms\Import\ImportEmployeesContractDataFromSalarySheet;
use App\Forms\Import\ImportHelperForm;
use App\Http\Controllers\Controller;
use App\Imports\ImportPaarthAttendanceAdd;
use App\Imports\ImportPaarthAttendanceCreateUser;
use App\Imports\ImportParthSalarySheet;
use App\Models\FormModels\DataEmpContract;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Validators\ValidationException;

class ImportController extends Controller
{
    public function importHelperForm()
    {
        $form = $this->form(ImportHelperForm::class, [
            'method' => 'POST',
            'url' => route('import-helper-data')
        ]);

        return view('layouts.hrms_forms', compact('form'));
    }

    public function importHelperData()
    {
        $form = $this->form(ImportHelperForm::class);
        $form->redirectIfNotValid();
        $formData = $this->formStoreData(ImportHelperForm::class);
        $heading_line_number_from_sheet = $formData['heading_line_number_from_sheet'];

        if ($form->getRequest()->hasFile('xlsx_file')) {
            $file = $form->getRequest()->file('xlsx_file');

            $heading = (new HeadingRowImport($heading_line_number_from_sheet))->toArray($file);

            echo json_encode($heading, JSON_PRETTY_PRINT);

//            $importEmpContracts = Excel::import(new ImportParthSalarySheet($heading_line_number_from_sheet, Auth::user()->getCompanyId()), $file);

        }
    }

    public function importEmployeesAttendanceForm()
    {
//        return view('layouts.test');
        $form = $this->form(ImportCreateUserAndAddAttendanceFromAttendanceSheetForm::class, [
            'method' => 'POST',
            'url' => route('generate-emp-attendances')
        ]);

        return view('layouts.hrms_forms', compact('form'));
    }

    public function generateEmpAndAttendanceFromAttendanceSheet()
    {
//        employees_attendance_sheet

        $form = $this->form(ImportCreateUserAndAddAttendanceFromAttendanceSheetForm::class);
        $form->redirectIfNotValid();
        $formData = $this->formStoreData(ImportCreateUserAndAddAttendanceFromAttendanceSheetForm::class);
        $attendance_month = $formData['attendance_month'];
        $attendance_year = $formData['attendance_year'];

        if ($form->getRequest()->hasFile('employees_attendance_sheet')) {
            try {

                $season_id = now()->unix();
                session(['import' => $season_id]);

                $file = $form->getRequest()->file('employees_attendance_sheet');

                $importCreateUser = Excel::import(new ImportPaarthAttendanceCreateUser(Auth::user()->getCompanyId(), $season_id), $file);

                $importAddAttendance = Excel::import(new ImportPaarthAttendanceAdd($attendance_month, $attendance_year), $file);

//                return redirect()->back();
            } catch (ValidationException $e) {
                $failures = $e->failures();

                echo json_encode($failures, JSON_PRETTY_PRINT);
            }
        } else {
            echo 'fail';
        }
    }

    public function status()
    {
        $id = session('import');

        return response([
            'started' => filled(cache("start_date_$id")),
            'finished' => filled(cache("end_date_$id")),
            'current_row' => (int)cache("current_row_$id"),
            'total_rows' => (int)cache("total_rows_$id"),
        ]);
    }

    public function importEmployeesContractForm()
    {
        $form = $this->form(ImportEmployeesContractDataFromSalarySheet::class, [
            'method' => 'POST',
            'url' => route('generate-emp-contracts')
        ]);

        return view('layouts.hrms_forms', compact('form'));
    }

    public function generateEmpContractsFromSalarySheet()
    {
//        employees_salary_sheet

        $form = $this->form(ImportEmployeesContractDataFromSalarySheet::class);
        $form->redirectIfNotValid();
        $formData = $this->formStoreData(ImportEmployeesContractDataFromSalarySheet::class);

        $heading_line_number_from_sheet = $formData['heading_line_number_from_sheet'];

        $data_emp_contract = new DataEmpContract($formData);

        if ($form->getRequest()->hasFile('employees_salary_sheet')) {
            try {

                $season_id = now()->unix();
                session(['import' => $season_id]);

                $file = $form->getRequest()->file('employees_salary_sheet');

                $importEmpContracts = Excel::import(new ImportParthSalarySheet($heading_line_number_from_sheet, Auth::user()->getCompanyId(), $data_emp_contract), $file);

//                return redirect()->back();
            } catch (ValidationException $e) {
                $failures = $e->failures();

                echo json_encode($failures, JSON_PRETTY_PRINT);
            }
        } else {
            echo 'fail';
        }
    }
}
