<?php

use Illuminate\Support\Facades\Route;

$roleAdminUriPrefix = 'dashboard/admin';
$roleSuperUserUriPrefix = 'dashboard/superuser';
$roleUserUriPrefix = 'dashboard/user';
$roleEndUserUriPrefix = 'dashboard/client';

### guest
Route::get('/', [
    App\Http\Controllers\Guest\HomeController::class, 'index'
])->name('guestIndex');

### auth
Auth::routes();

Route::get('/login/{provider}', [
    App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider'
])->name('oauthLogin');

Route::get('/login/{provider}/callback', [
    App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback'
])->name('oauthLoginCallback');

Route::get('dashboard', [
    App\Http\Controllers\Auth\DashboardController::class, 'index'
])->name('dashboardRedirect');

### admin
Route::prefix($roleAdminUriPrefix)->group(function() {
    Route::get('index', [
        App\Http\Controllers\Admin\HomeController::class, 'index'
    ])->name('adminIndex');

    Route::get('account-details', [
        App\Http\Controllers\Common\AccountController::class, 'ownAccountDetails'
    ])->name('adminOwnAccountDetails');

    Route::post('account-details/update', [
        App\Http\Controllers\Common\AccountController::class, 'updateOwnAccountDetails'
    ])->name('adminOwnAccountDetailsUpdate');

    Route::post('account-details/change-password', [
        App\Http\Controllers\Common\AccountController::class, 'changeOwnAccountPassword'
    ])->name('adminOwnAccountPasswordChange');

    Route::post('account-details/profile-image/upload', [
        App\Http\Controllers\Common\UploadController::class, 'uploadOwnAccountProfileImage'
    ])->name('adminOwnAccountProfileImageUpload');

    Route::get('users', [
        App\Http\Controllers\Admin\UserController::class, 'listUsers'
    ])->name('adminListUsers');

    Route::get('user/{id}', [
        App\Http\Controllers\Admin\UserController::class, 'getUser'
    ])->name('adminGetUser');
});

### superuser
Route::prefix($roleSuperUserUriPrefix)->group(function() {
    Route::get('index', [
        App\Http\Controllers\SuperUser\HomeController::class, 'index'
    ])->name('superuserIndex');

    Route::get('account-details', [
        App\Http\Controllers\Common\AccountController::class, 'ownAccountDetails'
    ])->name('superuserOwnAccountDetails');

    Route::post('account-details/update', [
        App\Http\Controllers\Common\AccountController::class, 'updateOwnAccountDetails'
    ])->name('superuserOwnAccountDetailsUpdate');

    Route::post('account-details/change-password', [
        App\Http\Controllers\Common\AccountController::class, 'changeOwnAccountPassword'
    ])->name('superuserOwnAccountPasswordChange');

    Route::post('account-details/profile-image/upload', [
        App\Http\Controllers\Common\UploadController::class, 'uploadOwnAccountProfileImage'
    ])->name('superuserOwnAccountProfileImageUpload');
});

### user
Route::prefix($roleUserUriPrefix)->group(function() {
    Route::get('index', [
        App\Http\Controllers\User\HomeController::class, 'index'
    ])->name('userIndex');

    Route::get('account-details', [
        App\Http\Controllers\Common\AccountController::class, 'ownAccountDetails'
    ])->name('userOwnAccountDetails');

    Route::post('account-details/update', [
        App\Http\Controllers\Common\AccountController::class, 'updateOwnAccountDetails'
    ])->name('userOwnAccountDetailsUpdate');

    Route::post('account-details/change-password', [
        App\Http\Controllers\Common\AccountController::class, 'changeOwnAccountPassword'
    ])->name('userOwnAccountPasswordChange');

    Route::post('account-details/profile-image/upload', [
        App\Http\Controllers\Common\UploadController::class, 'uploadOwnAccountProfileImage'
    ])->name('userOwnAccountProfileImageUpload');
});

### enduser
Route::prefix($roleEndUserUriPrefix)->group(function() {
    Route::get('index', [
        App\Http\Controllers\EndUser\HomeController::class, 'index'
    ])->name('enduserIndex');

    Route::get('account-details', [
        App\Http\Controllers\Common\AccountController::class, 'ownAccountDetails'
    ])->name('enduserOwnAccountDetails');

    Route::post('account-details/update', [
        App\Http\Controllers\Common\AccountController::class, 'updateOwnAccountDetails'
    ])->name('enduserOwnAccountDetailsUpdate');

    Route::post('account-details/change-password', [
        App\Http\Controllers\Common\AccountController::class, 'changeOwnAccountPassword'
    ])->name('enduserOwnAccountPasswordChange');

    Route::post('account-details/profile-image/upload', [
        App\Http\Controllers\Common\UploadController::class, 'uploadOwnAccountProfileImage'
    ])->name('enduserOwnAccountProfileImageUpload');
});
