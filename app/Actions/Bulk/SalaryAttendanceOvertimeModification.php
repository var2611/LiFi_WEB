<?php

namespace App\Actions\Bulk;

use App\Models\Attendance;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class SalaryAttendanceOvertimeModification extends Action
{
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "My action title";

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "plus-square";

    /**
     * Execute the action when the user clicked on the button
     *
     * @param Attendance[] $selectedModels Array with all the id of the selected models
     * @param $view Current view where the action was executed from
     */
    public function handle($selectedModels, View $view)
    {
        // Your code here
    }
}
