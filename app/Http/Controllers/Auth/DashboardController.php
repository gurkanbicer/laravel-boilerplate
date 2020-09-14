<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        switch (Auth::user()->role) {
            case 'admin':
                return redirect()->route('adminIndex');
                break;
            case 'superuser':
                return redirect()->route('superuserIndex');
                break;
            case 'user':
                return redirect()->route('userIndex');
                break;
            case 'enduser':
                return redirect()->route('enduserIndex');
                break;
        }
    }
}
