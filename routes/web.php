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
Route::get('dashboard', [
    App\Http\Controllers\Auth\DashboardController::class, 'index'
])->name('dashboardRedirect');

### admin
Route::prefix($roleAdminUriPrefix)->group(function() {
    Route::get('index', [
        App\Http\Controllers\Admin\HomeController::class, 'index'
    ])->name('adminIndex');
});

### superuser
Route::prefix($roleSuperUserUriPrefix)->group(function() {
    Route::get('index', [
        App\Http\Controllers\SuperUser\HomeController::class, 'index'
    ])->name('superuserIndex');
});

### user
Route::prefix($roleUserUriPrefix)->group(function() {
    Route::get('index', [
        App\Http\Controllers\User\HomeController::class, 'index'
    ])->name('userIndex');
});

### enduser
Route::prefix($roleEndUserUriPrefix)->group(function() {
    Route::get('index', [
        App\Http\Controllers\EndUser\HomeController::class, 'index'
    ])->name('enduserIndex');
});
