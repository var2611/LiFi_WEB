<?php

namespace App\Http\Controllers\web;

use App\Forms\Emp\EmployeeRegistrationForm;
use App\Forms\Emp\VehicleModificationForArmyForm;
use App\Forms\Emp\VehicleRegistrationForArmyForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\ListArmyVehicleView;
use App\Models\FormModels\DataEmpRegFor;
use App\Models\User;
use App\Models\UserEmployee;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Request;
use Kris\LaravelFormBuilder\Form;
use LaravelViews\LaravelViews;

class ConfigController extends Controller
{
    public function clearRoute()
    {
        Artisan::call('optimize:clear');
    }

}
