<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogPageController extends Controller
{
    public function onGetRequest(Request $r)
    {
        return view(
            'blog',
            [
                "page_title" => "Мой блог",
                "internal_path" => "/blog/"
            ]
        );
    }
}
