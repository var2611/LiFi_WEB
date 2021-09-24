<?php

namespace App\Models\FormModels;

/**
 * @property string|null $emp_code
 * @property string|null $name
 * @property string|null $surname
 * @property string|null $last_name
 * @property string|null $mobile
 */

class EmpRegForAtt
{
    /**
     *
     */
    public function __construct($formData)
    {
        $this->emp_code = $formData['emp_code'] ?? null;
        $this->name = $formData['name'] ?? null;
        $this->surname = $formData['surname'] ?? null;
        $this->last_name = $formData['last_name'] ?? null;
        $this->mobile = $formData['mobile'] ?? null;
    }
}
