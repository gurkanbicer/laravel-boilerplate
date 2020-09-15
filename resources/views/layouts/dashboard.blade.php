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
                </ul>
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
                        @if(isAuthRoleAdmin())
                            <a href="{{ route('adminOwnAccountDetails') }}" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> {{ __('Profile') }}
                            </a>
                        @endif
                        @if(isAuthRoleSuperUser())
                            <a href="{{ route('superuserOwnAccountDetails') }}" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> {{ __('Profile') }}
                            </a>
                        @endif
                        @if(isAuthRoleUser())
                            <a href="{{ route('userOwnAccountDetails') }}" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> {{ __('Profile') }}
                            </a>
                        @endif
                        @if(isAuthRoleEndUser())
                            <a href="{{ route('enduserOwnAccountDetails') }}" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> {{ __('Profile') }}
                            </a>
                        @endif
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
                    <a href="{{ route('dashboardRedirect') }}"><i class="fab fa-laravel text-primary mt-3" style="font-size: 32px;"></i></a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="{{ route('dashboardRedirect') }}"><i class="fab fa-laravel text-primary mt-3" style="font-size: 32px;"></i></a>
                </div>
                <ul class="sidebar-menu">
                    <li class="menu-header">{{ __('Menu') }}</li>
                    <li class="nav-item @if (\Route::is('adminIndex')) active @endif ">
                        <a href="{{ route('dashboardRedirect') }}"><i class="fas fa-columns"></i><span>{{ __('Dashboard') }}</span></a>
                    </li>
                    @if(isAuthRoleAdmin())
                        <li class="nav-item @if (\Route::is('adminListUsers')) active @endif ">
                            <a href="{{ route('adminListUsers') }}"><i class="fas fa-users"></i><span>{{ __('Users') }}</span></a>
                        </li>
                    @endif
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
