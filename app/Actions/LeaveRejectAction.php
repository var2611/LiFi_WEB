<?php

namespace App\Actions;

use App\Http\Livewire\ListLeaveEmployeesView;
use App\Models\EmployeeLeave;
use LaravelViews\Actions\Action;
use LaravelViews\Actions\Confirmable;
use LaravelViews\Views\View;

class LeaveRejectAction extends Action
{
    use Confirmable;

    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "Reject";

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "x-octagon";

    /**
     * Execute the action when the user clicked on the button
     *
     * @param $model EmployeeLeave object of the list where the user has clicked
//     * @param $view Current view where the action was executed from
     */
    public function handle($model, View $view)
    {
        $model->status = 2;
        $model->save();

        $this->success();
    }

    public function getConfirmationMessage($item = null)
    {
        return "Are you sure?";
    }
}
