<?php

namespace App\Http\Livewire;

use App\Models\UserEmployee;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class UserEmployeeTableView extends TableView
{
    public $searchBy = ['user.name', 'user.mobile', 'emp_code'];
    protected $paginate = 10;
    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        return UserEmployee::query()
            ->with(['User', 'UserRole']);
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title('Name'),
            Header::title('Mobile'),
            Header::title('Employee Code')->sortBy('emp_code'),
            Header::title('created at')->sortBy('created_at')
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model UserEmployee model for each row
     */
    public function row($model): array
    {
        return [
            $model->user->name,
            $model->user->mobile,
            $model->emp_code,
            $model->created_at->diffForHumans()
        ];
    }
}
