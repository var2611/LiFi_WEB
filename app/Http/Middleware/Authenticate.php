<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request
     * @return string|null
     */
    protected function redirectTo($request): ?string
    {
        if ($request->expectsJson()) {
            $controller = new Controller();
            if ($request->hasHeader('device'))
                $controller->return_response_pole($controller->pole_fail_data_value, 'AUTH Fail');
//            if ($request->hasHeader('ApplicationCode')) {
//                return response()->json($this->response, $this->status, []);
//                return $controller->return_response_unauthorised();
//                echo "not auth";
//            }
        } else {
            return '/login';
        }
        return $controller->return_response_unauthorised();
    }
}
