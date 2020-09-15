<?php

namespace App\Http\Controllers\SuperUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('superuser');
    }

    public function index(Request $request)
    {
        return view('dashboard.index');
    }

}
