<?php

namespace App\Http\Controllers\web;

use App\Forms\Salary\OverTimeTypeForm;
use App\Forms\Salary\SalaryAllowanceTypeForm;
use App\Forms\Salary\SalaryForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\TypeList\ListOverTimeType;
use App\Http\Livewire\TypeList\ListSalaryAllowanceType;
use App\Models\OvertimeType;
use App\Models\Salary;
use App\Models\SalaryAllowanceType;
use Illuminate\Support\Facades\Request;
use LaravelViews\LaravelViews;

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
        return $this->createList($laravelViews, ListSalaryAllowanceType::class, 'Salary Allowance Type List', 'salary');
    }

    public function overtimeTypeList(LaravelViews $laravelViews, Request $request): string
    {
        return $this->createList($laravelViews, ListOverTimeType::class, 'Overtime Type List', 'salary');
    }

    public function salaryCreate(string $id = null)
    {
        $model = new Salary();
        return $this->createForm($id, SalaryForm::class, $model, route('overtime-type-store'), 'salary');
    }
}
