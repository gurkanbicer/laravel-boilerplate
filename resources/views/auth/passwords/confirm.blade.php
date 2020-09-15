@extends('layouts.dashboard-auth')
@section('headerStyles')
    <link href="{{ asset('/assets/stisla/vendor/izitoast/dist/css/iziToast.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    <i class="fab fa-laravel text-primary" style="font-size: 64px"></i>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>{{ __('Confirm Password') }}</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf
                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">{{ __('Password') }}</label>
                                    @if (Route::has('password.request'))
                                        <div class="float-right">
                                            <a href="{{ route('password.request') }}" class="text-small">{{ __('Forgot Your Password?') }}</a>
                                        </div>
                                    @endif
                                </div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror " name="password" tabindex="2" required autocomplete="current-password">
                                @error('password')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    {{ __('Confirm Password') }}
                                </button>
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
