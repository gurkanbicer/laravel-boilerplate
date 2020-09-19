<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UploadUserProfileImage;
use Illuminate\Database\QueryException;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class UploadController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function changeUserProfileImage(UploadUserProfileImage $request)
    {
        try {
            $path = Storage::disk('public')
                ->put('profile-images', $request->file('profile_image'));

            User::query()
                ->where('id', '=', $request->input('id'))
                ->update([
                    'profile_image' => Storage::url($path),
                    'updated_at' => Carbon::now(),
                ]);

            $request->session()->flash('actionStatus', 'success');
            $request->session()->flash('actionStatusMessage', __('The user profile image has been changed.'));
            return redirect()->route('adminGetUser', ['id' => $request->input('id')]);
        } catch (QueryException $queryException) {
            $request->session()->flash('actionStatus', 'error');
            $request->session()->flash('actionStatusMessage', __('The user profile image could not changed.'));
            return redirect()->route('adminGetUser', ['id' => $request->input('id')]);
        }
    }

}
