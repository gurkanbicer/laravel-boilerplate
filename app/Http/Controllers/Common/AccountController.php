<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\Common\ChangeOwnAccountPassword;
use App\Http\Requests\Common\UpdateOwnAccountDetails;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ownAccountDetails(Request $request)
    {
        return view('dashboard.common.account-details');
    }

    public function updateOwnAccountDetails(UpdateOwnAccountDetails $request)
    {
        $accountDetails = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'display_name' => $request->input('display_name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];

        try {
            User::query()
                ->where('id', '=', Auth::id())
                ->update($accountDetails);

            $request->session()->flash('actionStatus', 'success');
            $request->session()->flash('actionStatusMessage', __('The account details has been updated.'));
            return redirect()->route('adminOwnAccountDetails');
        } catch (QueryException $queryException) {
            $request->session()->flash('actionStatus', 'error');
            $request->session()->flash('actionStatusMessage', __('The account details could not updated.'));
            return redirect()->route('adminOwnAccountDetails');
        }
    }

    public function changeOwnAccountPassword(ChangeOwnAccountPassword $request)
    {
        $accountDetails = [
            'password' => Hash::make($request->input('new_password')),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];

        try {
            User::query()
                ->where('id', '=', Auth::id())
                ->update($accountDetails);

            $request->session()->flash('actionStatus', 'success');
            $request->session()->flash('actionStatusMessage', __('The account password has been changed.'));
            return redirect()->route('adminOwnAccountDetails');
        } catch (QueryException $queryException) {
            $request->session()->flash('actionStatus', 'error');
            $request->session()->flash('actionStatusMessage', __('The account password could not changed.'));
            return redirect()->route('adminOwnAccountDetails');
        }
    }

}
