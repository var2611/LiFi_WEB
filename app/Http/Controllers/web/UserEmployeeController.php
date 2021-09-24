<?php


namespace App\Http\Controllers\web;


use App\Forms\Emp\EmployeeRegistrationForAttForm;
use App\Http\Controllers\Controller;
use App\Http\Livewire\UserEmployeeTableView;
use App\Models\FormModels\EmpRegForAtt;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use LaravelViews\LaravelViews;

class UserEmployeeController extends Controller
{

    use FormBuilderTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function empRegistrationForAttFormCreate()
    {
        $form = $this->form(EmployeeRegistrationForAttForm::class, [
            'method' => 'POST',
            'url' => route('emp-registration-att-store')
        ]);

        return view('layouts.hrms_forms', compact('form'));
    }

    public function empRegistrationForAttFormStore()
    {
        $form = $this->form(EmployeeRegistrationForAttForm::class);

        $form->redirectIfNotValid();

        // Do saving and other things...
        $formData = $form->getFieldValues();
        $empRegForAttForm = new EmpRegForAtt($formData);

        $user = att_register_user($empRegForAttForm->mobile, "New User");
        $user_employee = att_register_new_employee($empRegForAttForm, $user);

        if ($user_employee) {
            $data['status'] = true;
            $data['message'] = "Employee Has Been Registered.";
        } else {
            $data['status'] = false;
            $data['message'] = "Employee Registration Has some errors please try again or contact Admin.";
        }

        return redirect()->route('UsersList');
    }

    /**
     * Show the application dashboard.
     *
     * @return string
     */
    public function index(LaravelViews $laravelViews)
    {
        $laravelViews->create(UserEmployeeTableView::class)
            ->layout('main-list', 'container', [
                'title' => 'Users List'
            ]);

//        return view('user_employee_table', [
//            'view' => $laravelViews
//        ]);

        return $laravelViews->render();
    }

}
