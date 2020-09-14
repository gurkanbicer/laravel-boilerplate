<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EndUser
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role == "enduser") {
            return $next($request);
        }

        return redirect()->route('enduserDashboard')->with('error', "Only enduser can access!");
    }
}
