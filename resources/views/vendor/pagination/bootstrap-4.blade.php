@if ($paginator->hasPages())
    <div class="pagination-wrap">
        <ul>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span>قبلی</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}">قبلی</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><a href="#">1</a></li>
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <a class="active" href="#">{{ $page }}</a>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}">بعدی</a>
                </li>
            @else
                <li>
                    <span>بعدی</span>
                </li>
            @endif
        </ul>
    </div>
@endif
