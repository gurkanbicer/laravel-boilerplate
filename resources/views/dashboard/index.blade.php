@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Dashboard') }}</h1>
        </div>
        <div class="section-body">
            <div class="alert alert-light">
                @if(isAuthRoleAdmin())
                    <h5>{{ __('Hi, admin!') }}</h5>
                @endif

                @if(isAuthRoleSuperUser())
                    <h5>{{ __('Hi, super user!') }}</h5>
                @endif

                @if(isAuthRoleUser())
                    <h5>{{ __('Hi, user!') }}</h5>
                @endif

                @if(isAuthRoleEndUser())
                    <h5>{{ __('Hi, client!') }}</h5>
                @endif

                {{ __('Welcome back!') }}
            </div>
        </div>
    </section>
@endsection
