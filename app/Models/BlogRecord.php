<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogRecord extends Model
{
    protected $fillable = ["title", "image_path", "body_text"];

    public function comments()
    {
        return $this->hasMany(BlogRecordComment::class, 'blog_record_id');
    }
}
