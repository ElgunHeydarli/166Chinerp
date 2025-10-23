<div class="pagination">
    @if ($paginator->hasPages())
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a href="#" class="prev">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 5L9 12L15 19" stroke="#aaa" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" onclick="filter({{ request('page', 1) - 1 }})" class="prev">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 5L9 12L15 19" stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <p class="pagination_item">...</p>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a href="{{ $url }}" onclick="filter({{ $page }})"
                            class="pagination_item active">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}" onclick="filter({{ $page }})"
                            class="pagination_item">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" onclick="filter({{ request('page', 1) + 1 }})" class="next">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 5L15 12L9 19" stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        @else
            <a href="#" class="next">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 5L15 12L9 19" stroke="#aaa" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        @endif
    @endif
</div>
