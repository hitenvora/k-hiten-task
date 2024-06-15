<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    public function handle($request, Closure $next)
    {
        // Check if user is authenticated
        if (Auth::check()) {

            // Check if user type is 2 (or any other condition)
            if (Auth::user()->type == 1) {

                // Redirect to admin route
                return $next($request);
            }else{
                return redirect()->route('login.index');
            }

        } else {

            return redirect()->route("dashboard-overview-1");
        }

    }
}
