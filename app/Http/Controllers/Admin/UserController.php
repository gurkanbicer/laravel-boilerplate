<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    protected $itemLimit = 20;

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function listUsers(Request $request)
    {
        $users = User::query()
            ->paginate($this->itemLimit);

        return view('dashboard.admin.users', [
            'users' => $users
        ]);
    }

    public function getUser(Request $request, $id)
    {
        $user = User::query()
            ->where('id', '=', $id)
            ->first();

        if (is_null($user))
            abort(404);

        return response()->json($user);
    }

}
