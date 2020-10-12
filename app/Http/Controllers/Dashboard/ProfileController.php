<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\UpdateProfile;
use App\Http\Requests\Dashboard\UpdateProfileImage;
use App\Http\Requests\Dashboard\ChangePassword;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function editProfile(Request $request)
    {
        return view('dashboard.profile.edit');
    }

    public function updateProfile(UpdateProfile $request)
    {
        try {
            $user = User::findOrFail(Auth::id());
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->display_name = $request->input('display_name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->save();

            $request->session()->flash('actionStatus', 'success');
            $request->session()->flash('actionStatusMessage', __('The profile details has been updated.'));
            return redirect()->route('dashboardProfileEdit');
        } catch (QueryException $queryException) {
            $request->session()->flash('actionStatus', 'error');
            $request->session()->flash('actionStatusMessage', __('The profile details could not updated.'));
            return redirect()->route('dashboardProfileEdit');
        } catch (ModelNotFoundException $modelNotFoundException) {
            $request->session()->flash('actionStatus', 'error');
            $request->session()->flash('actionStatusMessage', __('The user not found.'));
            return redirect()->route('dashboardIndex');
        }
    }

    public function updateProfileImage(UpdateProfileImage $request)
    {
        try {
            $user = User::findOrFail(Auth::id());

            $path = Storage::disk('public')
                ->put('profile-images', $request->file('profile_image'));

            $user->profile_image = Storage::url($path);
            $user->save();

            $request->session()->flash('actionStatus', 'success');
            $request->session()->flash('actionStatusMessage', __('The profile image has been changed.'));
            return redirect()->route('dashboardProfileEdit');
        } catch (QueryException $queryException) {
            $request->session()->flash('actionStatus', 'error');
            $request->session()->flash('actionStatusMessage', __('The profile image could not changed.'));
            return redirect()->route('dashboardProfileEdit');
        } catch (ModelNotFoundException $modelNotFoundException) {
            $request->session()->flash('actionStatus', 'error');
            $request->session()->flash('actionStatusMessage', __('The user not found.'));
            return redirect()->route('dashboardIndex');
        }
    }

    public function changePassword(ChangePassword $request)
    {
        try {
            $user = User::findOrFail(Auth::id());
            $user->password =  Hash::make($request->input('new_password'));
            $user->save();

            $request->session()->flash('actionStatus', 'success');
            $request->session()->flash('actionStatusMessage', __('The password has been changed.'));
            return redirect()->route('dashboardProfileEdit');
        } catch (QueryException $queryException) {
            $request->session()->flash('actionStatus', 'error');
            $request->session()->flash('actionStatusMessage', __('The password could not changed.'));
            return redirect()->route('dashboardProfileEdit');
        } catch (ModelNotFoundException $modelNotFoundException) {
            $request->session()->flash('actionStatus', 'error');
            $request->session()->flash('actionStatusMessage', __('The user not found.'));
            return redirect()->route('dashboardIndex');
        }
    }
}
