<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\ChangeUserPassword;
use App\Http\Requests\Dashboard\DeleteUser;
use App\Http\Requests\Dashboard\UpdateUser;
use App\Http\Requests\Dashboard\UpdateUserProfileImage;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $itemLimit = 20;

    public function listUsers(Request $request)
    {
        $users = User::paginate($this->itemLimit);

        return view('dashboard.user.list', [
            'users' => $users
        ]);
    }

    public function editUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (is_null($user))
            abort(404);

        return view('dashboard.user.edit', [
            'user' => $user
        ]);
    }

    public function updateUser(UpdateUser $request)
    {
        try {
            $user = User::findOrFail($request->input('id'));

            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->display_name = $request->input('display_name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->status = $request->input('status');
            $user->role = $request->input('role');
            $user->save();

            $request->session()->flash('actionStatus', 'success');
            $request->session()->flash('actionStatusMessage', __('The user details has been updated.'));
            return redirect()->route('dashboardUserEdit', ['id' => $request->input('id')]);
        } catch (QueryException $queryException) {
            $request->session()->flash('actionStatus', 'error');
            $request->session()->flash('actionStatusMessage', __('The user details could not updated.'));
            return redirect()->route('dashboardUserEdit', ['id' => $request->input('id')]);
        } catch (ModelNotFoundException $modelNotFoundException) {
            $request->session()->flash('actionStatus', 'error');
            $request->session()->flash('actionStatusMessage', __('The user not found.'));
            return redirect()->route('dashboardUserList');
        }
    }

    public function deleteUser(DeleteUser $request)
    {
        try {
            User::destroy($request->input('id'));

            $request->session()->flash('actionStatus', 'success');
            $request->session()->flash('actionStatusMessage', __('The user has been deleted.'));
            return redirect()->route('dashboardUserList');
        } catch (QueryException $queryException) {
            $request->session()->flash('actionStatus', 'error');
            $request->session()->flash('actionStatusMessage', __('The user could not deleted.'));
            return redirect()->route('dashboardUserEdit', ['id' => $request->input('id')]);
        } catch (ModelNotFoundException $modelNotFoundException) {
            $request->session()->flash('actionStatus', 'error');
            $request->session()->flash('actionStatusMessage', __('The user not found.'));
            return redirect()->route('dashboardUserList');
        }
    }

    public function changeUserPassword(ChangeUserPassword $request)
    {
        try {
            $user = User::findOrFail($request->input('id'));
            $user->password = Hash::make($request->input('new_password'));
            $user->save();

            $request->session()->flash('actionStatus', 'success');
            $request->session()->flash('actionStatusMessage', __('The user password has been changed.'));
            return redirect()->route('dashboardUserEdit', ['id' => $request->input('id')]);
        } catch (QueryException $queryException) {
            $request->session()->flash('actionStatus', 'error');
            $request->session()->flash('actionStatusMessage', __('The user password could not changed.'));
            return redirect()->route('dashboardUserEdit', ['id' => $request->input('id')]);
        } catch (ModelNotFoundException $modelNotFoundException) {
            $request->session()->flash('actionStatus', 'error');
            $request->session()->flash('actionStatusMessage', __('The user not found.'));
            return redirect()->route('dashboardUserList');
        }
    }

    public function updateUserProfileImage(UpdateUserProfileImage $request)
    {
        try {
            $user = User::findOrFail($request->input('id'));

            $path = Storage::disk('public')
                ->put('profile-images', $request->file('profile_image'));

            $user->profile_image = Storage::url($path);
            $user->save();

            $request->session()->flash('actionStatus', 'success');
            $request->session()->flash('actionStatusMessage', __('The user profile image has been changed.'));
            return redirect()->route('dashboardUserEdit', ['id' => $request->input('id')]);
        } catch (QueryException $queryException) {
            $request->session()->flash('actionStatus', 'error');
            $request->session()->flash('actionStatusMessage', __('The user profile image could not changed.'));
            return redirect()->route('dashboardUserEdit', ['id' => $request->input('id')]);
        } catch (ModelNotFoundException $modelNotFoundException) {
            $request->session()->flash('actionStatus', 'error');
            $request->session()->flash('actionStatusMessage', __('The user not found.'));
            return redirect()->route('dashboardUserList');
        }
    }
}
