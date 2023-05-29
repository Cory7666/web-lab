<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogRecordComment extends Model
{
    protected $fillable = ["blog_record_id", "author_id", "body_text"];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function record()
    {
        return $this->belongsTo(BlogRecord::class, 'id');
    }
}
