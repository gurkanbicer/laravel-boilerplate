<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::prefix('dashboard')->group(function() {

    Route::get( 'index', [
        App\Http\Controllers\Dashboard\HomeController::class, 'index'
    ])->name('dashboardIndex')->middleware('enduser');

    Route::prefix('profile')->group(function () {

        Route::get( 'edit', [
            App\Http\Controllers\Dashboard\ProfileController::class, 'editProfile'
        ])->name('dashboardProfileEdit')->middleware('enduser');

        Route::post('update', [
            App\Http\Controllers\Dashboard\ProfileController::class, 'updateProfile'
        ])->name('dashboardProfileUpdate')->middleware('enduser');

        Route::post('change-password', [
            App\Http\Controllers\Dashboard\ProfileController::class, 'changePassword'
        ])->name('dashboardProfileChangePassword')->middleware('enduser');

        Route::post('account/profile-image/upload', [
            App\Http\Controllers\Dashboard\ProfileController::class, 'updateProfileImage'
        ])->name('dashboardProfileImageUpdate')->middleware('enduser');

    });

    Route::prefix('user')->group(function () {

        Route::get( 'list', [
            App\Http\Controllers\Dashboard\UserController::class, 'listUsers'
        ])->name('dashboardUserList')->middleware('admin');

        Route::get( 'edit/{id}', [
            App\Http\Controllers\Dashboard\UserController::class, 'editUser'
        ])->name('dashboardUserEdit')->middleware('admin');

        Route::post('update', [
            App\Http\Controllers\Dashboard\UserController::class, 'updateUser'
        ])->name('dashboardUserUpdate')->middleware('admin');

        Route::post('delete', [
            App\Http\Controllers\Dashboard\UserController::class, 'deleteUser'
        ])->name('dashboardUserDelete')->middleware('admin');

        Route::post('update/profile-image', [
            App\Http\Controllers\Dashboard\UserController::class, 'updateUserProfileImage'
        ])->name('dashboardUserUpdateProfileImage')->middleware('admin');

        Route::post('update/password', [
            App\Http\Controllers\Dashboard\UserController::class, 'changeUserPassword'
        ])->name('dashboardUserUpdatePassword')->middleware('admin');

    });

});

Route::redirect('dashboard', '/dashboard/index')->middleware('enduser');
