<?php

namespace App\Http\Livewire;

use App\Filters\UsersActiveFilter;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class UsersTableView extends TableView
{
    public $searchBy = ['name', 'email'];
    protected $paginate = 10;
    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        return User::query();
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title('Name')->sortBy('name'),
            Header::title('Email'),
            Header::title('Mobile')->sortBy('mobile'),
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
        return [$model->name, $model->email, $model->mobile, $model->created_at->diffForHumans()];
    }

    protected function filters()
    {
        return [
            new UsersActiveFilter,
        ];
    }
}
