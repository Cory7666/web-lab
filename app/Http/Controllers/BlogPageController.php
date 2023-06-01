<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBlogRecordCommentRequest;
use App\Http\Requests\CreateOneRecordRequest;
use App\Models\BlogRecord;
use App\Models\BlogRecordComment;
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

    public function onAddComment(AddBlogRecordCommentRequest $r)
    {
        $target_record = BlogRecord::where('id', '=', $r->get('blog_record_id'))->first();
        $text = $r->get('text_body');
        $user = Auth::user();
        
        BlogRecordComment::create([
            'blog_record_id' => $target_record->id,
            'author_id' => $user->id,
            'body_text' => $text,
        ]);

        return view('api.add_blog_comment', [
            'result' => true,
            'authorEmail' => $user->email,
            'text' => $text,
        ]);
    }

    public function onUpdateRecordContent(Request $r, int $pk)
    {
        $result = false;
        $new_content = '';
        $new_title = '';
        $record = BlogRecord::where('id', '=', $pk)->first();
        
        if ($record != null)
        {
            $record->title = $r->get('title');
            $record->body_text = $r->get('content');

            if ($r->hasFile('uploaded_image'))
            {
                $record->image_path = $r->file('uploaded_image')->store('/images', 'blog');
            }

            $record->save();

            $result = true;
            $new_content = $record->body_text;
            $new_title = $record->title;
        }

        return view('api.edit_record', [
            'result' => $result,
            'content' => $new_content,
            'title' => $new_title,
            'image_path' => "/lib/blog/".$record->image_path,
        ]);
    }

    public function onDeleteRecord(Request $r, int $pk)
    {
        BlogRecord::where('id', '=', $pk)->first()->delete();
        return redirect('/blog/');
    }
}
