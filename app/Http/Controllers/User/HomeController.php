<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('user');
    }

    public function index(Request $request)
    {
        return view('dashboard.index');
    }

}
