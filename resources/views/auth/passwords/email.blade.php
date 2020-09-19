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
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror "
                                       name="email" value="{{ old('email') }}" tabindex="1" required autocomplete="email" autofocus>
                                @error('email')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    {{ __('Send Password Reset Link') }}
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
