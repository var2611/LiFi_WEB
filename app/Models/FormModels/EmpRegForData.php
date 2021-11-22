<?php

namespace App\Models\FormModels;

use Auth;

/**
 * @property string|null $emp_code
 * @property string|null $name
 * @property string|null $surname
 * @property string|null $last_name
 * @property string|null $mobile
 * @property mixed|null $email
 * @property mixed|null $mac_address
 * @property mixed|null $is_active
 * @property mixed|null $is_visible
 * @property mixed|null $id
 * @property mixed|null $user_id
 * @property mixed|null $user_role_id
 * @property int|null $company_id
 */
class EmpRegForData
{
    private $formData;

    /**
     *
     */
    public function __construct($formData)
    {
        $this->formData = $formData;
    }

    public function attData(): EmpRegForData
    {
        $this->emp_code = $this->formData['emp_code'] ?? null;
        $this->name = $this->formData['name'] ?? null;
        $this->surname = $this->formData['surname'] ?? null;
        $this->last_name = $this->formData['last_name'] ?? null;
        $this->mobile = $this->formData['mobile'] ?? null;
        return $this;
    }

    public function userData(): EmpRegForData
    {
        $this->id = $this->formData['id'] ?? null;
        $this->name = $this->formData['name'] ?? null;
        $this->surname = $this->formData['surname'] ?? null;
        $this->last_name = $this->formData['last_name'] ?? null;
        $this->mobile = $this->formData['mobile'] ?? null;
        $this->email = $this->formData['email'] ?? null;
        $this->mac_address = $this->formData['mac_address'] ?? null;
        $this->is_active = $this->formData['is_active'] ?? 0;
        $this->is_visible = $this->formData['is_visible'] ?? 0;
        return $this;
    }

    public function userEmpData(): EmpRegForData
    {
        $this->user_id = $this->formData['id'] ?? null;
        $this->user_role_id = $this->formData['user_role_id'] ?? null;
        $this->company_id = Auth::user()->getCompanyId() ?? 1;
        $this->emp_code = $this->formData['emp_code'] ?? null;
        $this->is_active = $this->formData['is_active'] ?? 0;
        $this->is_visible = $this->formData['is_visible'] ?? 0;
        return $this;
    }

    public function paarthAttendanceUserdata(){
        $this->company_id = $this->formData['company_id'] ?? null;
        $this->name = $this->formData['name'] ?? null;
        $this->surname = $this->formData['surname'] ?? null;
        $this->emp_code = $this->formData['emp_code'] ?? null;
        return $this;
    }

}
