<?php

namespace App\Forms\Emp;

use App\Models\EmpContractType;
use Illuminate\Support\Arr;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class EmployeeContractTypeListForm extends Form
{
    public function buildForm()
    {
        $contractTypes = EmpContractType::get(['id', 'name'])->toArray();

        $this
            ->add('emp_contract_type_id', Field::SELECT, [
                'attr' => ['onchange' => 'getContractDetail()'],
                'id' => 'emp_contract_type_id',
                'choices' => Arr::pluck($contractTypes, 'name', 'id'),
                'empty_value' => '=== Select Type ===',
                'rules' => 'required',
                'label' => 'Select Contract',
            ])
            ->add('user_id', Field::HIDDEN, [
                'value' => $this->getModel()->user_id ?? null,
                'id' => 'user_id',
            ]);
    }
}
