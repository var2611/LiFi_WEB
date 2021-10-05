<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\UserEmployee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use LaravelViews\Actions\RedirectAction;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class ListEmployeeView extends TableView
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
        $user = Auth::user();
        $company_id = UserEmployee::whereUserId($user->id)->first()->company_id;

        $data = User::query()
            ->with(['UserEmployee', 'UserEmployee.UserRole:id,name']);

        if ($company_id != 1) {
            $data->whereHas('UserEmployee', function ($q) use ($company_id) {
                $q->where('company_id', '=', $company_id);
//                $q->where('user_id', '=', 'users.id');
            });
//            $data = $data->whereCompanyId($company_id);
        }

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
            Header::title('Surname'),
            Header::title('Mobile'),
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
            $model->surname,
            $model->mobile,
            $model->UserEmployee->flash_code ?? '',
            $model->created_at->diffForHumans()
        ];
    }

    protected function actionsByRow()
    {
        return [
            new RedirectAction("edit-user-profile", 'See user', 'edit'),
        ];
    }
}
