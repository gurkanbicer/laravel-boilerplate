@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Dashboard') }}</h1>
        </div>
        <div class="section-body">
            <div class="alert alert-success">
                @if(isAuthRoleAdmin())
                    {{ __('Hi, admin!') }}
                @endif

                @if(isAuthRoleSuperUser())
                    {{ __('Hi, super user!') }}
                @endif

                @if(isAuthRoleUser())
                    {{ __('Hi, user!') }}
                @endif

                @if(isAuthRoleEndUser())
                    {{ __('Hi, client!') }}
                @endif

                {{ __('Welcome back!') }}
            </div>
        </div>
    </section>
@endsection
