<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\Common\UploadOwnAccountProfileImage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function uploadOwnAccountProfileImage(UploadOwnAccountProfileImage $request)
    {
        try {
            $path = Storage::disk('public')
                ->put('profile-images', $request->file('profile_image'));

            User::query()
                ->where('id', '=', Auth::id())
                ->update([
                    'profile_image' => Storage::url($path),
                    'updated_at' => Carbon::now(),
                ]);

            $request->session()->flash('actionStatus', 'success');
            $request->session()->flash('actionStatusMessage', __('The profile image has been changed.'));
            return redirect()->route('adminOwnAccountDetails');
        } catch (QueryException $queryException) {
            $request->session()->flash('actionStatus', 'error');
            $request->session()->flash('actionStatusMessage', __('The profile image could not changed.'));
            return redirect()->route('adminOwnAccountDetails');
        }
    }

}
