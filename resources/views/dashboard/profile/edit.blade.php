@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Your Account Details') }}</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Basic Information') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboardProfileUpdate') }}">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label" for="first_name">{{ __('First Name') }}</label>
                                        <input type="text" id="first_name"
                                               class="form-control @error('first_name') is-invalid @enderror "
                                               name="first_name" value="{{ Auth::user()->first_name }}" autofocus
                                               required autocomplete="off">
                                        @error('first_name')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label" for="last_name">{{ __('Last Name') }}</label>
                                        <input type="text" id="last_name"
                                               class="form-control @error('last_name') is-invalid @enderror "
                                               name="last_name" value="{{ Auth::user()->last_name }}" required
                                               autocomplete="off">
                                        @error('last_name')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label" for="display_name">{{ __('Display Name') }}</label>
                                        <input type="text" id="display_name"
                                               class="form-control @error('display_name') is-invalid @enderror "
                                               name="display_name" value="{{ Auth::user()->display_name }}"
                                               autocomplete="off">
                                        @error('display_name')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label" for="username">{{ __('Username (nickname)') }}</label>
                                        <input type="text" id="username"
                                               class="form-control @error('username') is-invalid @enderror "
                                               name="username" value="{{ Auth::user()->username }}" autocomplete="off">
                                        @error('username')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="email">{{ __('E-Mail Address') }}</label>
                                    <input type="email" id="email"
                                           class="form-control @error('email') is-invalid @enderror " name="email"
                                           value="{{ Auth::user()->email }}" required autocomplete="off">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Profile Image') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboardProfileImageUpdate') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">{{ __('Current Profile Image') }}</label>
                                        @if(is_null(Auth::user()->profile_image))
                                            <img alt="image" src="{{ asset('/assets/stisla/img/avatar/avatar-1.png') }}" class="img-fluid mr-1">
                                        @else
                                            <img alt="image" src="{{ Auth::user()->profile_image }}" class="img-fluid mr-1">
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">{{ __('New Profile Image') }}</label>
                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">{{ __('Choose') }}</label>
                                            <input type="file" name="profile_image" id="image-upload" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ __('Change') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Change Password') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboardProfileChangePassword') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label" for="password">{{ __('Current Password') }}</label>
                                    <input type="password" id="password"
                                           class="form-control @error('password') is-invalid @enderror "
                                           name="password" value="" required autocomplete="off">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="new-password">{{ __('New Password') }}</label>
                                    <input type="password" id="new-password"
                                           class="form-control @error('new_password') is-invalid @enderror "
                                           name="new_password" value="" required autocomplete="off">
                                    @error('new_password')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="new-password-confirmation">{{ __('Confirm New Password') }}</label>
                                    <input type="password" id="new-password-confirmation"
                                           class="form-control @error('new_password_confirmation') is-invalid @enderror "
                                           name="new_password_confirmation" value="" required autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footerScripts')
    <script>
        $.uploadPreview({
            input_field: "#image-upload",
            preview_box: "#image-preview",
            label_field: "#image-label",
            label_default: "Choose",
            label_selected: "Change",
            no_label: false,
            success_callback: null
        });
    </script>
    @if (session('actionStatus') == "success")
        <script type="text/javascript">
            iziToast.success({
                title: '{{ __('Success') }}',
                message: ' {{ session('actionStatusMessage') }}',
                position: 'topRight'
            });
        </script>
    @endif
    @if (session('actionStatus') == "error")
        <script type="text/javascript">
            iziToast.error({
                title: '{{ __('Error') }}',
                message: ' {{ session('actionStatusMessage') }}',
                position: 'topRight'
            });
        </script>
    @endif
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
