<?php

namespace App\Models\FormModels;

use App\Models\EmployeeLeave;

/**
 * App\Models\LeaveApply
 * @property string|null $user_id
 * @property string|null $leave_type_id
 * @property string|null $date_from
 * @property string|null $date_to
 * @property string|null $from_time
 * @property string|null $to_time
 * @property string|null $days
 * @property string|null $reason
 * @property string|null $created_by
 * @property string|null $updated_by
 */
class ApplyLeave
{

    /**
     *
     */
    public function __construct($formData)
    {
        $this->user_id = $formData['user_id'] ?? null;
        $this->leave_type_id = $formData['leave_type'] ?? null;
        $this->date_from = $formData['date_from'] ?? null;
        $this->date_to = $formData['date_to'] ?? null;
        $this->from_time = $formData['from_time'] ?? null;
        $this->to_time = $formData['to_time'] ?? null;
        $this->days = $formData['days'] ?? null;
        $this->reason = $formData['reason'] ?? null;
        $this->created_by = $formData['created_by'] ?? null;
        $this->updated_by = $formData['updated_by'] ?? null;
    }

    /**
     * @param ApplyLeave $applyLeaveForm
     * @return EmployeeLeave
     */
    public function createEmployeeLeaveModel(ApplyLeave $applyLeaveForm): EmployeeLeave
    {
        $employee_leave = new EmployeeLeave();
        $employee_leave->user_id = $applyLeaveForm->user_id;
        $employee_leave->leave_type_id = $applyLeaveForm->leave_type_id;
        $employee_leave->date_from = $applyLeaveForm->date_from;
        $employee_leave->date_to = $applyLeaveForm->date_to;
        $employee_leave->from_time = $applyLeaveForm->from_time;
        $employee_leave->to_time = $applyLeaveForm->to_time;
        $employee_leave->days = $applyLeaveForm->days;
        $employee_leave->reason = $applyLeaveForm->reason;
        return $employee_leave;
    }
}
