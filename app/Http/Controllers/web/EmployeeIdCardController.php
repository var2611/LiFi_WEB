<?php

namespace App\Http\Controllers\web;

use App\Forms\Emp\EmployeeContractForm;
use App\Forms\Emp\EmployeeContractStatusForm;
use App\Forms\Emp\EmployeeContractTypeForm;
use App\Forms\Emp\EmployeeContractTypeListForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\ListContractsTypeView;
use App\Http\Livewire\ListEmpContractsView;
use App\Http\Livewire\ListEmployeeContractAmountType;
use App\Http\Livewire\ListEmployeeContractStatus;
use App\Models\EmpContract;
use App\Models\EmpContractStatus;
use App\Models\EmpContractType;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\Form;
use LaravelViews\LaravelViews;
use Redirect;

class EmployeeIdCardController extends Controller
{

}
