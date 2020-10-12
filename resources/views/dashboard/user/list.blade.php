@extends('layouts.dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Users') }}</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">#</th>
                                    <th class="text-left align-middle">{{ __('First Name') }}</th>
                                    <th class="text-left align-middle">{{ __('Last Name') }}</th>
                                    <th class="text-left align-middle">{{ __('Email') }}</th>
                                    <th class="text-center align-middle">{{ __('Login Type') }}</th>
                                    <th class="text-center align-middle">{{ __('Role') }}</th>
                                    <th class="text-center align-middle">{{ __('Status') }}</th>
                                    <th class="text-center align-middle">{{ __('Created At') }}</th>
                                    <th class="text-center align-middle">{{ __('Updated At') }}</th>
                                    <th class="text-center align-middle">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td class="text-center align-middle">
                                            @if(is_null($user->profile_image))
                                                <img alt="image" src="{{ asset('/assets/stisla/img/avatar/avatar-1.png') }}" class="rounded-circle" width="32px">
                                            @else
                                                <img alt="image" src="{{ $user->profile_image }}" class="rounded-circle" width="32px">
                                            @endif
                                        </td>
                                        <td class="text-left align-middle">{{ $user->first_name }}</td>
                                        <td class="text-left align-middle">{{ $user->last_name }}</td>
                                        <td class="text-left align-middle">{{ $user->email }}</td>
                                        <td class="text-center align-middle">
                                            @if(is_null($user->oauth_provider))
                                                <div class="badge badge-primary">{{ __('Normal') }}</div>
                                            @else
                                                <div class="badge badge-dark">{{ ucfirst($user->oauth_provider) }}</div>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            @switch($user->role)
                                                @case('admin')
                                                    <div class="badge badge-primary">{{ __('Admin') }}</div>
                                                @break

                                                @case('superuser')
                                                    <div class="badge badge-dark">{{ __('Super User') }}</div>
                                                @break

                                                @case('user')
                                                    <div class="badge badge-secondary">{{ __('User') }}</div>
                                                @break

                                                @case('enduser')
                                                    <div class="badge badge-dark">{{ __('Client') }}</div>
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="text-center align-middle">
                                            @switch($user->status)
                                                @case('active')
                                                <div class="badge badge-success">{{ __('Active') }}</div>
                                                @break

                                                @case('suspended')
                                                <div class="badge badge-warning">{{ __('Suspended') }}</div>
                                                @break

                                                @case('closed')
                                                <div class="badge badge-dark">{{ __('Closed') }}</div>
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="text-center align-middle">
                                            <a class="btn btn-primary btn-sm" href="{{ route('dashboardUserEdit', ['id' => $user->id]) }}">{{ __('Edit User') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($users->lastPage() > 1)
                    <div class="card-footer">
                        {{ $users->links('vendor.pagination.bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
@section('footerScripts')
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
