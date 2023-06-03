@if ($paginator->hasPages())
    <div class="bottom-information">
        <div class="dataTables_info">
            <div>
                <p class="text-sm text-gray-700 leading-5">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>
        </div>
        <div class="dataTables_paginate paging_simple_numbers">
            <div>
                <div class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <a>&laquo;</a>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}">&laquo;</a>
                    @endif
                    {{-- Pagination Elements --}}
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
                                    <a href="#" class="active">{{ $page }}</a>
                                @else
                                    <a href="{{ $url }}" class="">{{ $page }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
                    @else
                        <a href="">&raquo;</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
