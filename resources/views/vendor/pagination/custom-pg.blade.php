@if ($paginator->hasPages())
    <div class="clearfix"></div>
    <div class="pagination-container margin-top-20 margin-bottom-20">
    <nav class="pagination">
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="pagination-arrow" aria-label="@lang('pagination.previous')"><a href="#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-left"></i></a></li>
        @else

            <li class="pagination-arrow"><a href="{{ $paginator->previousPageUrl() }}" class="ripple-effect" rel="prev" aria-label="@lang('pagination.previous')"><i class="icon-material-outline-keyboard-arrow-left"></i></a></li>

        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active" aria-current="page"><a class="ripple-effect current-page" href="{{ $url }}">{{ $page }}</a></li>
                    @else
                        <li><a  class="ripple-effect " href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="pagination-arrow"><a href="{{ $paginator->nextPageUrl() }}" class="ripple-effect" rel="next" aria-label="@lang('pagination.next')"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
        @else
            <li class="pagination-arrow"><a href="{{ $paginator->nextPageUrl() }}" class="ripple-effect" rel="next" aria-label="@lang('pagination.next')"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
        @endif
    </ul>
    </nav>
    </div>
@endif
