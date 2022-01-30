<?php

namespace App\Models\FormModels;

/**
 *
 * @property mixed|null $start_date
 * @property mixed|null $end_date
 * @property mixed|null $days
 * @property mixed|null $hours
 * @property mixed|null $cap_amount_for_hra
 */
class DataEmpContract
{
    public function __construct($formData){
        $this->start_date = $formData['start_date'] ?? null;
        $this->end_date = $formData['end_date'] ?? null;
        $this->days = $formData['days'] ?? null;
        $this->hours = $formData['hours'] ?? null;
        $this->cap_amount_for_hra = $formData['hra_cap'] ?? null;
    }
}
