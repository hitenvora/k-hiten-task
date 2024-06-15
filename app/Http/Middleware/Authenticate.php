<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Redirect user if they are not authenticated.
     */
    // public function handle(Request $request, Closure $next): Response|JsonResponse|RedirectResponse
    public function handle(Request $request, Closure $next)
    {
        
        if (!is_null(request()->user())) {
            return $next($request);
        } else {

            return redirect()->route("login.index") ;
        }
    }
}
