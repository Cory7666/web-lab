<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BlogRecordComment extends Component
{
    public function __construct(
        public string $authorEmail,
        public string $text,
    )
    {}
    
    public function render(): View|Closure|string
    {
        return view('components.blog-record-comment', [
            'authorEmail' => $this->authorEmail,
            'text' => $this->text,
        ]);
    }
}
