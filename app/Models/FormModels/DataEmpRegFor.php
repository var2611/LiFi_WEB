<?php

namespace App\Models\FormModels;

use App\Models\User;
use App\Models\UserEmployee;
use Auth;

/**
 * @property string|null $emp_code
 * @property string|null $name
 * @property string|null $last_name
 * @property string|null $middle_name
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
class DataEmpRegFor
{
    private $formData;

    /**
     *
     */
    public function __construct($formData)
    {
        $this->formData = $formData;
    }

    public function attData(): DataEmpRegFor
    {
        $this->emp_code = $this->formData['emp_code'] ?? null;
        $this->name = $this->formData['name'] ?? null;
        $this->last_name = $this->formData['last_name'] ?? null;
        $this->middle_name = $this->formData['middle_name'] ?? null;
        $this->mobile = $this->formData['mobile'] ?? null;
        $this->id_photo = $this->formData['id_photo'] ?? null;
        $this->gender = $this->formData['gender'] ?? null;
        $this->date_of_joining = $this->formData['date_of_joining'] ?? null;
        $this->emp_department_type_id = $this->formData['emp_department_type_id'] ?? null;
        $this->user_role_id = $this->formData['user_role_id'] ?? null;
        $this->blood_group = $this->formData['blood_group'] ?? null;
        $this->date_of_birth = $this->formData['date_of_birth'] ?? null;
        $this->is_active = 1;
        return $this;
    }

    public function attDataUpdate(UserEmployee $userEmployee): DataEmpRegFor
    {
        $this->emp_code = $userEmployee->emp_code;
        $this->name = $userEmployee->User->name;
        $this->last_name = $userEmployee->User->last_name;
        $this->middle_name = $userEmployee->User->middle_name;
        $this->mobile = $userEmployee->User->mobile;
        $this->gender = $userEmployee->gender;
        $this->id_photo = $userEmployee->id_photo;
        $this->date_of_joining = $userEmployee->date_of_joining;
        $this->emp_department_type_id = $userEmployee->emp_department_type_id;
        $this->user_role_id = $userEmployee->user_role_id;
        $this->blood_group = $userEmployee->blood_group;
        $this->date_of_birth = $userEmployee->date_of_birth;
        $this->is_active = 1;
        return $this;
    }

    public function userData(): DataEmpRegFor
    {
        $this->id = $this->formData['id'] ?? null;
        $this->name = $this->formData['name'] ?? null;
        $this->last_name = $this->formData['last_name'] ?? null;
        $this->middle_name = $this->formData['middle_name'] ?? null;
        $this->mobile = $this->formData['mobile'] ?? null;
        $this->email = $this->formData['email'] ?? null;
        $this->mac_address = $this->formData['mac_address'] ?? null;
        $this->is_active = 1;
        $this->is_visible = $this->formData['is_visible'] ?? 0;
        return $this;
    }

    public function userEmpData(): DataEmpRegFor
    {
        $this->user_id = $this->formData['id'] ?? null;
        $this->user_role_id = $this->formData['user_role_id'] ?? null;
        $this->company_id = Auth::user()->getCompanyId() ?? 1;
        $this->emp_code = $this->formData['emp_code'] ?? null;
        $this->gender = $this->formData['gender'] ?? null;
        $this->date_of_joining = $this->formData['date_of_joining'] ?? null;
        $this->id_photo = $this->formData['id_photo'] ?? null;
        $this->emp_department_type_id = $this->formData['emp_department_type_id'] ?? null;
        $this->blood_group = $this->formData['blood_group'] ?? null;
        $this->date_of_birth = $this->formData['date_of_birth'] ?? null;
        $this->is_active = 1 ;
        $this->is_visible = $this->formData['is_visible'] ?? 0;
        return $this;
    }

}
