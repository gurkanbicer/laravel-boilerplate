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
                    <div class="card-header"><h4>{{ __('Verify Your Email Address') }}</h4></div>
                    <div class="card-body">
                        <p class="text-muted">{{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},</p>

                        <form method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    {{ __('Click here to request another') }}
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
    @if (session('resent'))
        <script type="text/javascript">
            iziToast.success({
                title: '{{ __('Success') }}',
                message: '{{ __("A fresh verification link has been sent to your email address.") }}',
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
