<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\UserEmployee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use LaravelViews\Actions\RedirectAction;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class ListArmyVehicleView extends TableView
{
    public $searchBy = ['name', 'mobile', 'UserEmployee.emp_code'];
    protected $paginate = 20;

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        $company_id = Auth::user()->getCompanyId();

        $data = User::query()
            ->with(['UserEmployee', 'UserEmployee.UserRole:id,name', 'VehicleDrivers:id,vehicle_id,driver_id', 'VehicleDrivers.Driver:id,name']);

        if ($company_id != 1) {
            $data->whereHas('UserEmployee', function ($q) use ($company_id) {
                $q->where('company_id', '=', $company_id);
                $q->where('user_role_id', '=', '7');
            });
//            $data = $data->whereCompanyId($company_id);
        }

//        dd($data->get());


        return $data;
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title('Employee Code')->sortBy('emp_code'),
            Header::title('Name'),
            Header::title('Vehicle No'),
            Header::title('Driver Name'),
            Header::title('Flash Code')->sortBy('flash_code'),
            Header::title('created at')->sortBy('created_at')
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model User model for each row
     */
    public function row($model): array
    {
        return [
            $model->UserEmployee->emp_code ?? '',
            $model->name,
            $model->mobile,
            $model->VehicleDrivers->Driver->name,
            $model->UserEmployee->flash_code ?? '',
            $model->created_at->diffForHumans()
        ];
    }

    protected function actionsByRow()
    {
        return [
            new RedirectAction("edit-army-vehicle-profile", 'Edit Profile', 'edit'),
        ];
    }
}
