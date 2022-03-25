@if ($paginator->hasPages())
    <nav class="blog-pagination mt-4" aria-label="Pagination">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled btn btn-outline-secondary" aria-disabled="true">@lang('pagination.previous')</li>
            @else
                <li>
                    <a class="btn btn-outline-primary" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a class="btn btn-outline-primary" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                </li>
            @else
                <li class="disabled btn btn-outline-secondary" aria-disabled="true">@lang('pagination.next')</li>
            @endif
        </ul>
    </nav>
@endif
