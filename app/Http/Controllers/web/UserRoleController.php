<?php


namespace App\Http\Controllers\web;


use App\Forms\UserRoleForm;
use App\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\FormBuilder;

class UserRoleController extends Controller
{

    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(UserRoleForm::class, [
            'method' => 'POST',
            'url' => route('leave-store')
        ]);

        return view('layouts.hrms_forms', compact('form'));
    }
}
