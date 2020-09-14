<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class User
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role == "user") {
            return $next($request);
        }

        return redirect()->route('userDashboard')->with('error', "Only user can access!");
    }
}
