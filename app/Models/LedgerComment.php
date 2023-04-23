<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LedgerComment extends Model
{
    protected $fillable = [ "firstname", "lastname", "email", "body_text" ];
}
