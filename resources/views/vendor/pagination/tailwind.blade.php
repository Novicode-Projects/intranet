@if ($paginator->hasPages())
    <nav role="navigation" aria-label="...">
        {{-- Pagination Elements --}}
        <ul class="pagination pagination-sm">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><span class="pagination-ellipsis">&hellip;</span></li>
                @endif
                {{-- Array Of Links --}}
                @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><a class="page-link" aria-label="Goto page {{ $page }}">{{ $page }}</a></li>
                            @else
                                <li class="page-item"><a href="{{ $url }}" class="page-link" aria-label="Goto page {{ $page }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                @endif
            @endforeach
        </ul>
    </nav>
@endif