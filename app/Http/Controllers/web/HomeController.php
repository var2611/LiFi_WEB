<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use LaravelViews\LaravelViews;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $companyData = $user->getCompanyData();

        return view('hrms.dashboard', $companyData);
    }

    public function welcome(Request $request)
    {
        if (Auth::user()->isFreeLiFiWiFi()) {
            return redirect()->route('list-free-lifi-wifi-file');
        }
        return view('hrms.welcome');

    }

    public function demo(LaravelViews $laravelViews)
    {
//        echo bcrypt('gil@wifi#lifi');
//        echo  getTodayDateTime();

//       echo getDateTimeFromStringAsFormat("Y-m-d H.i", "Y-m-d H:i", '2021-10-1 15.55');
//        echo Attendance::whereDate('created_at', today())->count();

//        $user = \Illuminate\Support\Facades\Auth::user();
//        $company_id = UserEmployee::whereUserId($user->id)->first()->company_id;
//
//        $data = User::join('user_employees', 'user_employees.user_id', '=', 'users.id')
//            ->where('user_employees.company_id', $company_id)
//            ->with(['UserEmployee', 'UserEmployee.UserRole:id,name']);
//
//        if ($company_id != 1) {
////            $data = $data->whereHas('user_employees', function ($q) use ($company_id) {
////                $q->where('company_id', '=', $company_id);
////            });
////            $data = $data->whereCompanyId($company_id);
//        }
//
//        echo json_encode($data->get(), JSON_PRETTY_PRINT);

//        echo phpinfo();

//        $company_id = 4;
//
//        $emp_pf_details = EmpPfDetail::with(['UserEmployee:id,user_id,company_id'])
//            ->whereHas('UserEmployee', function ($q) use ($company_id) {
//                $q->where('company_id', '=', $company_id);
//            })->get(['id', 'user_id', 'pf_number', 'uan', 'bank_name', 'description', 'status', 'is_visible', 'is_active'])->toArray();
//
//        $pf_search_data = array_search(223, array_column($emp_pf_details, 'user_id'));
//
//        if ($pf_search_data !== false)
//            echo json_encode($emp_pf_details[$pf_search_data]['user_id']) . '<br>';
//        else
//            echo 'na';

        echo validateSalaryGenerate(11, 2021, $this);
    }
}
