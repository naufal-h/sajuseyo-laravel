@if ($paginator->hasPages())
    <div class="page-numbers nav-links">
        @if ($paginator->onFirstPage())
        @else
            <span class="prev">
                <a href="{{ $paginator->previousPageUrl() }}" title="">
                    <svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 4H6H1M1 4L4.28467 1M1 4L4.28467 7" stroke="black" stroke-linecap="round"
                            stroke-linejoin="round">
                        </path>
                    </svg>
                </a>
            </span>
        @endif

        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span aria-disabled="true">
                    <span
                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">{{ $element }}</span>
                </span>
            @endif
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page current">
                            {{ $page }}
                        </span>
                        <a href="#" class="active"></a>
                    @else
                        <span class="page">
                            <a href="{{ $url }}" title="">
                                {{ $page }}
                            </a>
                        </span>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <span class="next">
                <a href="{{ $paginator->nextPageUrl() }}" title="">
                    <svg width="12" height="8" viewBox="0 0 12 8" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 4H6H11M11 4L7.71533 1M11 4L7.71533 7" stroke="black" stroke-linecap="round"
                            stroke-linejoin="round">
                        </path>
                    </svg>
                </a>
            </span>
        @else
        @endif
    </div>
@endif
