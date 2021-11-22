<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\User;
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
            return redirect()->route('free-lifi-wifi-file-list');
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

    }
}
