<?php

namespace App\Http\Controllers\web;

use App\Forms\WorkShift\EmployeeWorkShiftForm;
use App\Forms\WorkShift\WorkShiftForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\ListEmpWorkShift;
use App\Models\EmpShiftData;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
            $model = EmpShiftData::whereUserId($id)->with('EmpWorkShift')->first();

            if (empty($model)) {
                $model = new EmpShiftData();
            }
            return $this->createFormData(
                EmployeeWorkShiftForm::class,
                route('store-work-shift', ['id' => $id]),
                'contract',
                $model,
                $id
            );

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
        $model = new EmpShiftData();

        $formData = $this->formStoreData(EmployeeWorkShiftForm::class);
        dd($formData);

        return $this->formStore(WorkShiftForm::class, $model, 'list-holiday', 'holiday', 'Holiday');
    }

    public function listEmpWorkShiftView(LaravelViews $laravelViews): string
    {
        return $this->createList($laravelViews, ListEmpWorkShift::class, 'Employees Work Shift List', 'employee');
    }
}
