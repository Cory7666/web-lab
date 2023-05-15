<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOneRecordRequest;
use App\Models\BlogRecord;
use App\Models\SpyingRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogPageController extends Controller
{
    private static int $perPageMessagesCount = 4;

    public function onGetRequest(Request $r)
    {
        SpyingRecord::spy_stealthily($r);

        return view(
            'blog',
            [
                "page_title" => "Мой блог",
                "internal_path" => "/blog/",
                'records' => BlogRecord::orderBy('created_at', 'desc')->paginate(BlogPageController::$perPageMessagesCount),
            ]
        );
    }

    public function onPostRequest(CreateOneRecordRequest $r)
    {
        if ($r->hasFile('uploaded_image')) {
            $local_filename = $r->file('uploaded_image')->store('/images', 'blog');
            BlogRecord::create([
                'title' => $r->title,
                'body_text' => $r->body,
                'image_path' => $local_filename,
            ]);
        } else {
            BlogRecord::create([
                'title' => $r->title,
                'body_text' => $r->body,
            ]);
        }

        return redirect('/blog');
    }
}
