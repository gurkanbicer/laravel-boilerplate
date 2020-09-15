@extends('layouts.dashboard-auth')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    <img src="/assets/stisla/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
                </div>
                <div class="card card-primary">
                    <div class="card-header"><h4>{{ __('Verify Your Email Address') }}</h4></div>
                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif
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
                    Copyright &copy; {{ \Carbon\Carbon::now()->format('Y') }} - {{ env('APP_NAME') }}
                </div>
            </div>
        </div>
    </div>
@endsection
