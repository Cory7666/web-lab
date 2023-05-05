<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SpyingRecord extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        private string $datetime,
        private string $ip,
        private string $userAgent,
        private string $hostname,
        private string $path,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.spying-record', [
            'datetime' => $this->datetime,
            'ip' => $this->ip,
            'userAgent' => $this->userAgent,
            'hostname' => $this->hostname,
            'path' => $this->path,
        ]);
    }
}
