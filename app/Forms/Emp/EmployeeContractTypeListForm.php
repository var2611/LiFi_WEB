<?php

namespace App\Forms\Emp;

use App\Models\EmpContractType;
use Auth;
use Illuminate\Support\Arr;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class EmployeeContractTypeListForm extends Form
{
    public function buildForm()
    {
        $contractTypes = EmpContractType::whereCompanyId(Auth::user()->getCompanyId())->get(['id', 'name'])->toArray();

//        dd($contractTypes);

        $this
            ->add('contract_type_id', Field::SELECT, [
                'attr' => ['onchange' => 'getContractDetail()'],
//                'id' => 'contract_i',
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
