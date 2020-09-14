<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SuperUser
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role == "superuser") {
            return $next($request);
        }

        return redirect()->route('superuserDashboard')->with('error', "Only super user can access!");
    }
}
