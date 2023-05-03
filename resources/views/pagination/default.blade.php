@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" aria-disabled="true"><span>@lang('pagination.previous')</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
        @endif

        @if ($paginator->lastPage() <= 7)
            @for ($pageNum = 1; $pageNum <= $paginator->lastPage(); $pageNum++)
                <li>
                    @if ($pageNum == $paginator->currentPage())
                        <span>{{ $pageNum }}</span>
                    @else
                        <a href="{{ $paginator->url($pageNum) }}">{{ $pageNum }}</a>
                    @endif
                </li>
            @endfor
        @else
            @if (4 > $paginator->currentPage())
                {{-- 1 2 3 4 ... n --}}
                @for ($pageNum = 1; $pageNum <= 4; $pageNum++)
                    <li>
                        @if ($pageNum == $paginator->currentPage())
                            <span>{{ $pageNum }}</span>
                        @else
                            <a href="{{ $paginator->url($pageNum) }}">{{ $pageNum }}</a>
                        @endif
                    </li>
                @endfor
                <li>...</li>
                <li><a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
            @else
                @if ($paginator->currentPage() > $paginator->lastPage() - 3)
                    {{-- 1 ... (n-3) (n-2) (n-1) n --}}
                    <li><a href="{{ $paginator->url(1) }}">1</a></li>
                    <li>...</li>
                    @for ($pageNum = $paginator->lastPage() - 3; $pageNum <= $paginator->lastPage(); $pageNum++)
                        <li>
                            @if ($pageNum == $paginator->currentPage())
                                <span>{{ $pageNum }}</span>
                            @else
                                <a href="{{ $paginator->url($pageNum) }}">{{ $pageNum }}</a>
                            @endif
                        </li>
                    @endfor
                @else
                    {{-- 1 ... (c-1) c (c+1) ... n --}}
                    <li><a href="{{ $paginator->url(1) }}">1</a></li>
                    <li>...</li>
                    <li><a href="{{ $paginator->previousPageUrl() }}">{{ $paginator->currentPage() - 1 }}</a></li>
                    <li><span>{{ $paginator->currentPage() }}</span></li>
                    <li><a href="{{ $paginator->nextPageUrl() }}">{{ $paginator->currentPage() + 1 }}</a></li>
                    <li>...</li>
                    <li><a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
                    </li>
                @endif
            @endif
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
        @else
            <li class="disabled" aria-disabled="true"><span>@lang('pagination.next')</span></li>
        @endif
    </ul>
@endif
