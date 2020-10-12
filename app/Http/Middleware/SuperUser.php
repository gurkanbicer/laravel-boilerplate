<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperUser
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (havePermission('superuser')) {
                return $next($request);
            }

            return redirect()->route('dashboardIndex')->withErrors([__("You don't have authorized for this request.")]);
        } else {
            return redirect()->route('login');
        }
    }
}
