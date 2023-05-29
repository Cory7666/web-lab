<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SendBlogRecordCommentForm extends Component
{
    public function __construct(
        public string $blogRecordId,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.send-blog-record-comment-form', [
            'blog_record_id' => $this->blogRecordId,
        ]);
    }
}
