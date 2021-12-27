<?php

namespace App\Http\Controllers\web;

use App\Forms\Other\HolidayForm;
use App\Forms\WorkShift\WorkShiftForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\ListEmpWorkShift;
use App\Models\EmpWorkShift;
use App\Models\Holiday;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use LaravelViews\LaravelViews;
use Redirect;

class EmployeeWorkShiftController extends Controller
{

    /**
     * @param string|null $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function editFormWorkShift(string $id = null)
    {
        try {
            $model = EmpWorkShift::whereId($id)->first();

            if (!$model) {
                $model = new EmpWorkShift();
            }

            return $this->createForm(null, WorkShiftForm::class, $model, route('store-work-shift'), 'contract');

        } catch (Exception $exception) {
            echo $exception->getMessage();
            $this->notifyMessage(false, 'Site Error : ' . $exception->getMessage());
            return Redirect::back();
        }
    }

    /**
     * @return RedirectResponse
     */
    public function storeFormWorkShift(): RedirectResponse
    {
        $model = new EmpWorkShift();

        return $this->formStore(WorkShiftForm::class, $model, 'list-holiday', 'holiday', 'Holiday');
    }

    public function listEmpWorkShiftView(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, ListEmpWorkShift::class, 'Employees Work Shift List', 'salary');
    }
}
