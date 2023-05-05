<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpyingRecord extends Model
{
    protected $fillable = [
        'path',
        'client_ip',
        'client_user_agent',
        'client_hostname',
    ];
}
