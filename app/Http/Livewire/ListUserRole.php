<?php

namespace App\Http\Livewire;

use App\Models\UserRole;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Actions\RedirectAction;
use LaravelViews\Facades\Header;
use LaravelViews\Facades\UI;
use LaravelViews\Views\TableView;
use LaravelViews\Views\Traits\WithAlerts;

class ListUserRole extends TableView
{
    use WithAlerts;

    public $searchBy = ['name'];
    /** After */
//    protected $model = UserRole::class;

    /** Before */
    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        return UserRole::query()->whereIsVisible(0);
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title('No')->sortBy('id'),
            Header::title('Name')->sortBy('name'),
            Header::title('created at')->sortBy('created_at')
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model UserRole model for each row
     */
    public function row(UserRole $model): array
    {
        return [
            $model->id,
            UI::editable($model, 'name'),
            $model->created_at,
        ];
    }

    public function update(UserRole $model, $data)
    {
        $model->update($data);
        $this->success();
    }

    /**
     * @return RedirectAction[]
     */
    protected function actionsByRow(): array
    {
        return [
            new RedirectAction("user-role-edit", 'See user', 'edit'),
        ];
    }
}
