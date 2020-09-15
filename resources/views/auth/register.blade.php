@extends('layouts.dashboard-auth')
@section('headerStyles')
    <link href="{{ asset('/assets/stisla/vendor/izitoast/dist/css/iziToast.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div
                    class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                    <div class="login-brand">
                        <i class="fab fa-laravel text-primary" style="font-size: 64px"></i>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ __('Register') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="first_name">{{ __('First Name') }}</label>
                                        <input id="first_name" type="text"
                                               class="form-control  @error('first_name') is-invalid @enderror "
                                               name="first_name" value="{{ old('first_name') }}" autofocus
                                               autocomplete="first_name">
                                        @error('first_name')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="last_name">{{ __('Last Name') }}</label>
                                        <input id="last_name" type="text"
                                               class="form-control @error('last_name') is-invalid @enderror "
                                               name="last_name" value="{{ old('last_name') }}" autocomplete="last_name">
                                        @error('last_name')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror "
                                           name="email" value="{{ old('email') }}" autocomplete="email">
                                    @error('email')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
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
                                    <div class="form-group col-6">
                                        <label for="password-confirm"
                                               class="d-block">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        {{ __('Register') }}
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
    </section>
@endsection
@section('footerScripts')
    <script src="{{ asset('/assets/stisla/vendor/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('/assets/stisla/js/page/auth-register.js') }}"></script>
    <script src="{{ asset('/assets/stisla/vendor/izitoast/dist/js/iziToast.min.js') }}"></script>
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
