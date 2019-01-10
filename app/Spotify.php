<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spotify extends Model
{
    protected $fillable = [
        'email',
        'access_token',
        'refresh_token',
    ];

    protected $table = 'spotify';
}
