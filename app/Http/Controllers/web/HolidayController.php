<?php

namespace App\Http\Controllers\web;

use App\Forms\Other\HolidayForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\ListHoliday;
use App\Models\Holiday;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use LaravelViews\LaravelViews;
use Redirect;

class HolidayController extends Controller
{

    public function listHoliday(LaravelViews $laravelViews): string
    {

        return $this->createList($laravelViews, ListHoliday::class, 'Holiday List', 'holiday', 'edit-holiday');

    }

    /**
     * @param string|null $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function editFormHoliday(string $id = null)
    {
        try {
            $model = Holiday::whereId($id)->first();

            if (!$model) {
                $model = new Holiday();
                $model->company_id = Auth::user()->getCompanyId();
            }

            return $this->createForm(
                HolidayForm::class,
                route('store-holiday'),
                'contract',
                $model);

        } catch (Exception $exception) {
            echo $exception->getMessage();
            $this->notifyMessage(false, 'Site Error : ' . $exception->getMessage());
            return Redirect::back();
        }
    }

    /**
     * @return RedirectResponse
     */
    public function storeFormHoliday(): RedirectResponse
    {
        $model = new Holiday();

        return $this->formStore(HolidayForm::class, $model, 'list-holiday', 'holiday', 'Holiday');
    }
}
