<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdminType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!is_null(request()->user())) {
            if (auth::user()->type == 0) {
                // Redirect to admin route
                return $next($request);
            }else{
                Auth::logout();
                return redirect()->route("index.view");
            }
        } else {
            return redirect()->route("login.index") ;
        }
    }
}
