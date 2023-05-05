<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SpyingRecord extends Model
{
    public static function spy_stealthily(Request $r)
    {
        SpyingRecord::create([
            'path' => $r->path(),
            'client_ip' => $r->ip(),
            'client_hostname' => $r->getHttpHost(),
            'client_user_agent' => $r->userAgent()
        ]);
    }

    protected $fillable = [
        'path',
        'client_ip',
        'client_user_agent',
        'client_hostname',
    ];
}
