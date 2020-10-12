<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    use HasFactory;

    protected $table = 'user_meta';

    protected $fillable = [
        'meta_key', 'meta_value'
    ];

    protected $hidden = [
        'user_id'
    ];

    public $timestamps = false;

    const CREATED_AT = false;

    const UPDATED_AT = false;

}
