<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if ($request->expectsJson()) {
            $controller = new Controller();
            if ($request->hasHeader('pole'))
                $controller->return_response_pole($controller->pole_fail_data_value, 'AUTH Fail');
        }
        return view('login');
    }
}
