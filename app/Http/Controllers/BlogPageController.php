<?php

namespace App\Http\Controllers;

use App\Models\BlogRecord;
use Illuminate\Http\Request;

use function Termwind\render;

class BlogPageController extends Controller
{
    public function onGetRequest(Request $r)
    {
        return view(
            'blog',
            [
                "page_title" => "Мой блог",
                "internal_path" => "/blog/",
                'records' => BlogRecord::all(),
            ]
        );
    }

    public function onPostRequest(Request $r)
    {
        $this->validate(
            $r,
            [
                'title' => ['required'],
                'body' => ['required'],
            ]
        );
        
        render($r->hasFile('uploaded_image'));
        if ($r->hasFile('uploaded_image'))
        {
            $local_filename = $r->file('uploaded_image')->store('/images', 'blog');
            BlogRecord::create([
                'title' => $r->title,
                'body_text' => $r->body,
                'image_path' => $local_filename,
            ]);
        }
        else
        {
            BlogRecord::create([
                'title' => $r->title,
                'body_text' => $r->body,
            ]);
        }

        return redirect('/blog');
    }
}
