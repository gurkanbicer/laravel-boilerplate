<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
            } else if ($account->status == "closed") {
                $this->incrementLoginAttempts($request);
                return $this->sendFailedLoginResponse($request, 'closed');
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

    public function redirectToProvider(Request $request, $provider)
    {
        switch ($provider) {
            case 'github':
                return Socialite::driver($provider)->redirect();
                break;
            default:
                abort(404);
        }
    }

    public function handleProviderCallback(Request $request, $provider)
    {
        switch ($provider) {
            case 'github':
                try {
                    $user = Socialite::driver($provider)->user();
                } catch (InvalidStateException $InvalidStateException) {
                    return redirect()->route('login')->withErrors(['email' => 'Unknown error.']);
                }
                break;
            default:
                abort(404);
        }

        $localProviderUser = User::query()
            ->where('oauth_provider', '=', $provider)
            ->where('oauth_id', '=', $user->getId())
            ->first();

        if (!is_null($localProviderUser)) {
            if ($localProviderUser->status == "suspended") {
                return $this->sendFailedLoginResponse($request, 'suspended');
            } else if ($localProviderUser->status == "closed") {
                return $this->sendFailedLoginResponse($request, 'closed');
            }

            Auth::loginUsingId($localProviderUser->id);
            return $this->sendLoginResponse($request);
        } else {
            $isHaveLocalUser = User::query()
                ->where('email', '=', $user->getEmail())
                ->count();

            if ($isHaveLocalUser === 0) {
                $nameSplit = explode(' ', $user->getName());
                $userId = User::query()
                    ->insertGetId([
                        'email' => $user->getEmail(),
                        'password' => Hash::make(Str::random(16)),
                        'role' => 'enduser',
                        'status' => 'active',
                        'first_name' => $nameSplit[0],
                        'last_name' => $nameSplit[1] ?? $nameSplit[0],
                        'username' => $user->getNickname(),
                        'display_name' => null,
                        'oauth_provider' => $provider,
                        'oauth_id' => $user->getId(),
                        'profile_image' => $user->getAvatar(),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                Auth::loginUsingId($userId);
                return $this->sendLoginResponse($request);
            } else {
                return redirect()->route('login')->withErrors(['email' => 'The account already exists. Please login with your email and password.']);
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
