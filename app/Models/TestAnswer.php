<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestAnswer extends Model
{
    protected $fillable = [ "name", "group", "q1_answer", "q2_answer", "q3_answer" ];
}
