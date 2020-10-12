<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'first_name', 'last_name', 'display_name', 'username', 'email', 'password', 'profile_image', 'role', 'status'
    ];

    protected $hidden = [
        'password', 'remember_token', 'role', 'status', 'oauth_provider', 'oauth_id'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
