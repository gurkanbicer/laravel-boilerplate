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
    <div class="main-wrapper">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                </ul>
                <div class="search-element">
                    <input class="form-control" type="search" placeholder="{{ __('Search') }}" aria-label="Search" data-width="250">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        @if(is_null(Auth::user()->profile_image))
                            <img alt="image" src="/assets/stisla/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                        @else
                            <img alt="image" src="{{ Auth::user()->profile_image }}" class="rounded-circle mr-1">
                        @endif
                        <div class="d-sm-none d-lg-inline-block">{{ __('Hi, :name', ['name' => Auth::user()->first_name . ' ' . Auth::user()->last_name ]) }}</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> {{ __('Profile') }}
                        </a>
                        <a href="#" class="dropdown-item has-icon">
                            <i class="fas fa-cog"></i> {{ __('Settings') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="main-sidebar">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="{{ route('dashboardRedirect') }}">{{ env('APP_NAME') }}</a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="{{ route('dashboardRedirect') }}">{{ substr(env('APP_NAME'), 0, 1) }}</a>
                </div>
                <ul class="sidebar-menu">
                    <li class="menu-header">{{ __('Dashboard') }}</li>
                    <li class="nav-item">
                        <a href="{{ route('dashboardRedirect') }}"><i class="fas fa-columns"></i><span>{{ __('Getting started') }}</span></a>
                    </li>
                    @yield('sidebar')
                </ul>
                <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                    <a href="{{ route('guestIndex') }}" class="btn btn-primary btn-lg btn-block btn-icon-split">
                        <i class="fas fa-rocket"></i> {{ __('Go to Website') }}
                    </a>
                </div>
            </aside>
        </div>
        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
        <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; {{ \Carbon\Carbon::now()->format('Y') }} - {{ env('APP_NAME') }}
            </div>
            <div class="footer-right">
                {{ __('Build with Laravel v:version', ['version' => Illuminate\Foundation\Application::VERSION]) }}
            </div>
        </footer>
    </div>
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