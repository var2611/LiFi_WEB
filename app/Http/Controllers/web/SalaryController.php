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
        return $this->saveFormData(OverTimeTypeForm::class, $model, 'leave-type-list', 'salary', 'Over Time Type');
    }
    public function salaryAllowanceTypeCreate(string $id = null)
    {
        $model = new SalaryAllowanceType();
        return $this->createForm($id, SalaryAllowanceTypeForm::class, $model, route('salary-allowance-type-store'), 'salary');
    }

    public function salaryAllowanceTypeStore(): string
    {
        $model = new SalaryAllowanceType();
        return $this->saveFormData(SalaryAllowanceTypeForm::class, $model, 'leave-type-list', 'salary', 'Salary Allowance Type');
    }

}
