<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->role == "admin") {
                return $next($request);
            }
        }

        return redirect()->route('dashboardRedirect')->with('error', "Only admin can access!");
    }
}
