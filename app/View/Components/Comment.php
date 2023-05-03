<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Comment extends Component
{
    public function __construct(
        private string $authorFirstname,
        private string $authorLastname,
        private string $email,
        private string $commentBody,
        private string $createdAt 
    )
    {}

    public function render(): View|Closure|string
    {
        return view(
            'components.comment',
            [
                'author' => $this->authorLastname . " " . $this->authorFirstname[0] . ".",
                'email' => $this->email,
                'comment_body' => $this->commentBody,
                'created_at' => $this->createdAt
            ]
        );
    }
}
