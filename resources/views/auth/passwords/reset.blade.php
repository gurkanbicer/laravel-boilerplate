@extends('layouts.dashboard-auth')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    <i class="fab fa-laravel text-primary" style="font-size: 64px"></i>
                </div>
                <div class="card card-primary">
                    <div class="card-header"><h4>{{ __('Reset Password') }}</h4></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror "
                                       name="email" value="{{ $email ?? old('email') }}" tabindex="1" required autocomplete="email" autofocus>
                                @error('email')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="d-block">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                       class="form-control pwstrength @error('password') is-invalid @enderror "
                                       data-indicator="pwindicator" name="password" required
                                       autocomplete="new-password">
                                <div id="pwindicator" class="pwindicator">
                                    <div class="bar"></div>
                                    <div class="label"></div>
                                </div>
                                @error('password')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password-confirm"
                                       class="d-block">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                            <div class="form-divider"></div>
                            <div class="form-group">
                                <a class="btn btn-info" href="{{ route('login') }}">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="simple-footer">
                    Copyright &copy; {{ \Carbon\Carbon::now()->format('Y') }} - <span class="text-primary font-weight-bold">{{ env('APP_NAME') }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footerScripts')
    <script src="{{ asset('/assets/stisla/node_modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('/assets/stisla/js/page/auth-register.js') }}"></script>
    @if (session('status'))
        <script type="text/javascript">
            iziToast.success({
                title: '{{ __('Success') }}',
                message: ' {{ session('status') }}',
                position: 'bottomCenter'
            });
        </script>
    @endif
    @if(!empty($errors->all()))
        <script type="text/javascript">
            @foreach($errors->all() as $error)
            iziToast.error({
                title: '{{ __('Error') }}',
                message: '{{ $error }}',
                position: 'bottomCenter'
            });
            @endforeach
        </script>
    @endif
@endsection
