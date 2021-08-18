<?php

namespace App\Actions;

use App\Models\EmployeeLeave;
use LaravelViews\Actions\Action;
use LaravelViews\Actions\Confirmable;
use LaravelViews\Views\View;

class LeaveApproveAction extends Action
{
    use Confirmable;

    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "Approve";

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "check-square";

    /**
     * Execute the action when the user clicked on the button
     *
     * @param $model EmployeeLeave object of the list where the user has clicked
     * @param $view Current view where the action was executed from
     */
    public function handle($model, View $view)
    {
        $model->status = 1;
        $model->save();

        $this->success();
    }

    public function getConfirmationMessage($item = null)
    {
        return "Are you sure?";
    }
}
