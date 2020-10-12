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
                    <p class="lead">This is your dashoard. Your role is <strong>{{ getUserRoleName() }}.</strong></p>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footerScripts')
    @if(!empty($errors->all()))
        <script type="text/javascript">
            @foreach($errors->all() as $message)
            iziToast.error({
                title: '{{ __('Error') }}',
                message: '{{ $message }}',
                position: 'topRight'
            });
            @endforeach
        </script>
    @endif
@endsection
