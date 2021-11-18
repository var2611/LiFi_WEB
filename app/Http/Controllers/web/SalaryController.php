<?php

namespace App\Http\Controllers\web;

use App\Forms\Salary\ImportSalary;
use App\Forms\Salary\OverTimeTypeForm;
use App\Forms\Salary\SalaryAllowanceTypeForm;
use App\Forms\Salary\SalaryForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\ListOverTimeType;
use App\Http\Livewire\ListSalaryAllowanceType;
use App\Models\ImportPublicWifiSeasonData;
use App\Models\OvertimeType;
use App\Models\Salary;
use App\Models\SalaryAllowanceType;
use Illuminate\Support\Facades\Request;
use LaravelViews\LaravelViews;
use Maatwebsite\Excel\Validators\ValidationException;

class SalaryController extends Controller
{
    public function overTimeTypeCreate(string $id = null)
    {
        $model = new OvertimeType();
        return $this->createForm($id, OverTimeTypeForm::class, $model, route('overtime-type-store'), 'salary');
    }

    public function overTimeTypeStore(): string
    {
        $model = new OvertimeType();
        return $this->formStore(OverTimeTypeForm::class, $model, 'list-overtime-type', 'salary', 'Over Time Type');
    }

    public function salaryAllowanceTypeCreate(string $id = null)
    {
        $model = new SalaryAllowanceType();
        return $this->createForm($id, SalaryAllowanceTypeForm::class, $model, route('salary-allowance-type-store'), 'salary');
    }

    public function salaryAllowanceTypeStore(): string
    {
        $model = new SalaryAllowanceType();
        return $this->formStore(SalaryAllowanceTypeForm::class, $model, 'list-salary-allowance-type', 'salary', 'Salary Allowance Type');
    }

    public function salaryAllowanceTypeList(LaravelViews $laravelViews, Request $request): string
    {
        return $this->createList($laravelViews, ListSalaryAllowanceType::class, 'Salary Allowance Type List', 'salary', route('salary-allowance-type-edit'));
    }

    public function overtimeTypeList(LaravelViews $laravelViews, Request $request): string
    {
        return $this->createList($laravelViews, ListOverTimeType::class, 'Overtime Type List', 'salary', route('overtime-type-edit'));
    }

    public function salaryCreate(string $id = null)
    {
        $model = new Salary();
        return $this->createForm($id, SalaryForm::class, $model, route('overtime-type-store'), 'salary');
    }

    public function importSalaryCreate()
    {
        $model = new ImportPublicWifiSeasonData();
        $form = $this->createFormData(null, ImportSalary::class, $model, route('import-salary-store'), 'salary');

        return $this->createFormView($form);
    }

    public function importSalaryStore()
    {
        $model = new ImportPublicWifiSeasonData();
//        $form = $this->formStoreData(ImportSalary::class);
        $form = $this->form(ImportSalary::class);
        $form->redirectIfNotValid();

//        print_r($form->getFieldValues());
        if ($form->getRequest()->hasFile('salary_sheet')) {

            try {
                $file = $form->getRequest()->file('salary_sheet');
//                $import = Excel::import(new ImportParthSalarySheet(), $file);

//                (new ImportParthSalarySheet)->toCollection($file);

//                $heading = (new HeadingRowImport(1))->toArray($file);

//                echo json_encode($heading, JSON_PRETTY_PRINT);
            } catch (ValidationException $e) {
                $failures = $e->failures();

                echo json_encode($failures, JSON_PRETTY_PRINT);
            }

            echo 'Success';
        } else {
            echo 'Fail';
        }

    }
}
