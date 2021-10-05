<?php

namespace App\Http\Controllers\web;

use App\Forms\Salary\OverTimeTypeForm;
use App\Forms\Salary\SalaryAllowanceTypeForm;
use App\Http\Controllers\Controller;
use App\Models\OvertimeType;
use App\Models\SalaryAllowanceType;

class SalaryController extends Controller
{
    public function overTimeTypeCreate(string $id = null)
    {
        $model = new OvertimeType();
        return $this->createForm($id, OverTimeTypeForm::class, $model, route('over-time-type-store'), 'salary');
    }

    public function overTimeTypeStore(): string
    {
        $model = new OvertimeType();
        return $this->formStore(OverTimeTypeForm::class, $model, 'list-leave-type', 'salary', 'Over Time Type');
    }
    public function salaryAllowanceTypeCreate(string $id = null)
    {
        $model = new SalaryAllowanceType();
        return $this->createForm($id, SalaryAllowanceTypeForm::class, $model, route('salary-allowance-type-store'), 'salary');
    }

    public function salaryAllowanceTypeStore(): string
    {
        $model = new SalaryAllowanceType();
        return $this->formStore(SalaryAllowanceTypeForm::class, $model, 'list-leave-type', 'salary', 'Salary Allowance Type');
    }

}
