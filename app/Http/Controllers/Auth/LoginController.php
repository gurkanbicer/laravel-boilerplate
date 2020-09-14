<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $account = User::query()
            ->where('email', '=', $request->input('email'))
            ->first();

        if (!is_null($account)) {
            if ($account->status == "suspended") {
                $this->incrementLoginAttempts($request);
                return $this->sendFailedLoginResponse($request, 'suspended');
                //return Redirect::back()->with(['email', 'The account has been suspended.']);
            } else if ($account->status == "closed") {
                $this->incrementLoginAttempts($request);
                return $this->sendFailedLoginResponse($request, 'closed');
                //return Redirect::back()->with(['email', 'The account has been closed.']);
            }
        }

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendFailedLoginResponse(Request $request, $key = 'failed')
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.' . $key)],
        ]);
    }

}
