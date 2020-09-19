<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UpdateUser;
use App\Http\Requests\Admin\ChangePassword;
use App\Http\Requests\Admin\DeleteUser;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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

        return view('dashboard.admin.edit-user', [
            'user' => $user
        ]);
    }

    public function updateUser(UpdateUser $request)
    {
        $accountDetails = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'display_name' => $request->input('display_name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'status' => $request->input('status'),
            'role' =>  $request->input('role'),
            'updated_at' => Carbon::now(),
        ];

        try {
            User::query()
                ->where('id', '=', $request->input('id'))
                ->update($accountDetails);

            $request->session()->flash('actionStatus', 'success');
            $request->session()->flash('actionStatusMessage', __('The user details has been updated.'));
            return redirect()->route('adminGetUser', ['id' => $request->input('id')]);
        } catch (QueryException $queryException) {
            $request->session()->flash('actionStatus', 'error');
            $request->session()->flash('actionStatusMessage', __('The user details could not updated.'));
            return redirect()->route('adminGetUser', ['id' => $request->input('id')]);
        }
    }

    public function changePassword(ChangePassword $request)
    {
        $accountDetails = [
            'password' => Hash::make($request->input('new_password')),
            'updated_at' => Carbon::now(),
        ];

        try {
            User::query()
                ->where('id', '=', $request->input('id'))
                ->update($accountDetails);

            $request->session()->flash('actionStatus', 'success');
            $request->session()->flash('actionStatusMessage', __('The user password has been changed.'));
            return redirect()->route('adminGetUser', ['id' => $request->input('id')]);

        } catch (QueryException $queryException) {
            $request->session()->flash('actionStatus', 'error');
            $request->session()->flash('actionStatusMessage', __('The user password could not changed.'));
            return redirect()->route('adminGetUser', ['id' => $request->input('id')]);
        }
    }

    public function deleteUser(DeleteUser $request)
    {
        try {
            User::query()
                ->where('id', '=', $request->input('id'))
                ->delete();

            $request->session()->flash('actionStatus', 'success');
            $request->session()->flash('actionStatusMessage', __('The user has been deleted.'));
            return redirect()->route('adminListUsers');
        } catch (QueryException $queryException) {
            $request->session()->flash('actionStatus', 'error');
            $request->session()->flash('actionStatusMessage', __('The user could not deleted.'));
            return redirect()->route('adminListUsers');
        }
    }

}
