<?php

namespace App\Http\Controllers;

use App\Models\BlogRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogPageController extends Controller
{
    public function onGetRequest(Request $r)
    {
        Storage::disk('blog_images')->put('123.txt', "Hello, World! I am a dumbest document in the Storage.");
        return view(
            'blog',
            [
                "page_title" => "Мой блог",
                "internal_path" => "/blog/",
                'records' => BlogRecord::all(),
            ]
        );
    }
}
