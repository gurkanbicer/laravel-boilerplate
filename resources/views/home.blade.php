@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
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
            </div>
        </div>
    </div>
@endsection
