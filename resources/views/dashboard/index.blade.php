@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Dashboard') }}</h1>
        </div>
        <div class="section-body">
            <div class="hero bg-primary text-white">
                <div class="hero-inner">
                    <h2>{{ __('Welcome back, :name!', ['name' => Auth::user()->first_name]) }}</h2>
                    <p class="lead">This is your dashoard. Your role is <strong>{{ getAuthenticatedUserRole() }}.</strong></p>
                </div>
            </div>
        </div>
    </section>
@endsection
