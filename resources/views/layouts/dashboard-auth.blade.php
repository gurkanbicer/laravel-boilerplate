<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ $page_title ?? env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('/assets/stisla/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/stisla/vendor/fontawesome5/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/stisla/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/stisla/css/components.css') }}">
    @yield('headerStyles')
    @yield('headerScripts')
</head>
<body>
<div id="app">
    @yield('content')
</div>
<script src="{{ asset('/assets/stisla/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('/assets/stisla/js/popper.min.js') }}"></script>
<script src="{{ asset('/assets/stisla/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/assets/stisla/js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('/assets/stisla/js/moment.min.js') }}"></script>
<script src="{{ asset('/assets/stisla/js/stisla.js') }}"></script>
<script src="{{ asset('/assets/stisla/js/scripts.js') }}"></script>
<script src="{{ asset('/assets/stisla/js/custom.js') }}"></script>
@yield('footerScripts')
</body>
</html>

