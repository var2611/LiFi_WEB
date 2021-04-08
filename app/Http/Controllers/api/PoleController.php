<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pole;
use App\Models\PoleLight;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Exception as ExceptionAlias;

class PoleController extends Controller
{

    public function login(Request $request)
    {
        $rules = [
            'mac' => 'required|size:12',
            'password' => 'required',
        ];

        $token = '';

        if ($this->ApiValidator($request->all(), $rules)) {
            $mac_address = strtoupper($request->mac ?? null);
            $password = $request->password;

            if (Auth::attempt(['mac_address' => $mac_address
                , 'password' => $password])) {

                $user = Auth::user();
                $token = create_user_auth_token($user);

            } else {
                $token = $this->create_pole($request);
            }
        } else {
            $this->return_response_pole(0, "Wrong Parameter");
        }
        $data = "Authorization:Bearer $token";
        $this->return_response_pole(1, $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     */
    public function create_pole(Request $request)
    {
        $token = '';
        try {

            $mac_address = strtoupper($request->mac ?? null);
            $password = $request->password ?? null;

            $name = 'Pole';


            $user = User::where('mac_address', $mac_address)->first(['id']);
            if ($user) {
                $this->return_response_pole(0, "Duplicate MAC Address");
            } else {
                $input = array();
                $input['Name'] = $name;
                $input['mac_address'] = $mac_address;
                $input['password'] = $password;
                $user = User::create($input);

                if ($user) {
                    if (Auth::attempt(['mac_address' => $mac_address
                        , 'password' => $password])) {

                        $user = Auth::user();
                        $token = create_user_auth_token($user);

                        $input = array();
                        $input['Name'] = $name;
                        $input['mac_address'] = $mac_address;
                        $input['user_id'] = $user->id;
                        $input['created_by'] = Auth::user()->id;
                        $input['updated_by'] = Auth::user()->id;
                        $pole = Pole::create($input);

                        $input = array();
                        $input['pole_id'] = $pole->id;
                        $input['created_by'] = Auth::user()->id;
                        $input['updated_by'] = Auth::user()->id;
                        $pole_light = PoleLight::create($input);

                    } else {
                        $this->return_response_pole(0, "Login Fail");
                    }
                }
            }
        } catch (ExceptionAlias $ex) {
            $this->return_response_pole(0, $ex);
        }

        return $token;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Pole $pole
     * @return \Illuminate\Http\Response
     */
    public function show(Pole $pole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Pole $pole
     * @return \Illuminate\Http\Response
     */
    public function edit(Pole $pole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pole $pole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pole $pole)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Pole $pole
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pole $pole)
    {
        //
    }
}
