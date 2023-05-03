<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BlogRecord extends Component
{
    public function __construct(
        private string $title,
        private string $createdAt,
        private string $bodyText,
        private $imagePath = NULL
    )
    {}

    public function render(): View|Closure|string
    {
        return view(
            'components.blog-record',
            [
                'title' => $this->title,
                'created_at' => $this->createdAt,
                'body_text' => $this->bodyText,
                'imagepath' => (($this->imagePath == '' || $this->imagePath == NULL) ? FALSE : "/lib/blog/" . $this->imagePath),
            ]
        );
    }
}
