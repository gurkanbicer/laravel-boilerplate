@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="flex-grow-1">{{ __('Edit User: :name', ['name' => $user->first_name . ' ' . $user->last_name]) }}</h1>
            <a class="btn btn-primary text-white ml-3" href="{{ route('dashboardUserList') }}"><i class="fas fa-angle-double-left"></i> {{ __('Back to users') }}</a>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Basic Information') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboardUserUpdate') }}">
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label" for="first_name">{{ __('First Name') }}</label>
                                        <input type="text" id="first_name"
                                               class="form-control @error('first_name') is-invalid @enderror "
                                               name="first_name" value="{{ $user->first_name }}" autofocus
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
                                               name="last_name" value="{{ $user->last_name }}" required
                                               autocomplete="off">
                                        @error('last_name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label"
                                               for="display_name">{{ __('Display Name') }}</label>
                                        <input type="text" id="display_name"
                                               class="form-control @error('display_name') is-invalid @enderror "
                                               name="display_name" value="{{ $user->display_name }}"
                                               autocomplete="off">
                                        @error('display_name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label"
                                               for="username">{{ __('Username (nickname)') }}</label>
                                        <input type="text" id="username"
                                               class="form-control @error('username') is-invalid @enderror "
                                               name="username" value="{{ $user->username }}"
                                               autocomplete="off">
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
                                           value="{{ $user->email }}" required autocomplete="off">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                @if($user->id != Auth::user()->id)
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label class="control-label" for="status">{{ __('Status') }}</label>
                                            <select id="status" class="form-control" name="status">
                                                <option value="active" @if($user->status == "active") selected @endif >{{ __('Active') }}</option>
                                                <option value="suspended" @if($user->status == "suspended") selected @endif >{{ __('Suspended') }}</option>
                                                <option value="closed" @if($user->status == "closed") selected @endif >{{ __('Closed') }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label class="control-label" for="role">{{ __('Role') }}</label>
                                            <select id="role" class="form-control" name="role">
                                                <option value="admin" @if($user->role == "admin") selected @endif >{{ __('Admin') }}</option>
                                                <option value="superuser" @if($user->role == "superuser") selected @endif >{{ __('Super User') }}</option>
                                                <option value="user" @if($user->role == "user") selected @endif >{{ __('User') }}</option>
                                                <option value="enduser" @if($user->role == "enduser") selected @endif >{{ __('Enduser') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                @else
                                    <input type="hidden" name="status" value="{{ $user->status }}">
                                    <input type="hidden" name="role" value="{{ $user->role }}">
                                @endif
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Change Password') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboardUserUpdatePassword') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <div class="form-group">
                                    <label class="control-label"
                                           for="new-password">{{ __('New Password') }}</label>
                                    <input type="password" id="new-password"
                                           class="form-control @error('new_password') is-invalid @enderror "
                                           name="new_password" value="" required
                                           autocomplete="off">
                                    @error('new_password')
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
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Profile Image') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('dashboardUserUpdateProfileImage') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">{{ __('Current Profile Image') }}</label>
                                        @if(is_null($user->profile_image))
                                            <img alt="image" src="{{ asset('/assets/stisla/img/avatar/avatar-1.png') }}"
                                                 class="img-fluid mr-1">
                                        @else
                                            <img alt="image" src="{{ $user->profile_image }}" class="img-fluid mr-1">
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">{{ __('New Profile Image') }}</label>
                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">{{ __('Choose') }}</label>
                                            <input type="file" name="profile_image"
                                                   id="image-upload"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ __('Change') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if($user->id != Auth::user()->id)
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('Delete Account') }}</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('dashboardUserDelete') }}" id="accountDeleteForm">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <div class="form-group">
                                        <p class="text-danger">{{ __('When you delete the account then you can not undo this action. You may want to change account status as closed or suspended. If account status is closed or suspended, the user cannot access to dashboard.') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-danger" id="accountDeleteBtn">{{ __('Ok, delete it.') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footerScripts')
    <script src="{{ asset('/assets/stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
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
    <script>
        $("#accountDeleteBtn").click(function(e) {
            e.preventDefault();
            swal({
                title: 'Are you sure?',
                text: 'You can not undo this.',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $('#accountDeleteForm').submit();
                } else {
                    swal('Account could not deleted.');
                }
            });
        });
    </script>
@endsection
