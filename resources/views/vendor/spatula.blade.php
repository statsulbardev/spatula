@if ($paginator->hasPages())
    <nav>
        <ul class="mt-6 flex flex-wrap justify-start">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="mr-1 mb-1 px-4 py-3 text-sm border rounded text-gray-400" aria-hidden="true">
                        Sebelumnya
                    </span>
                </li>
            @else
                <li>
                    <a wire:click="previousPage" class="cursor-pointer mr-1 mb-1 px-4 py-3 text-sm border rounded hover:bg-white focus:border-primary-500 focus:text-primary-500" rel="prev" aria-label="@lang('pagination.previous')">
                        Sebelumnya
                    </a>
                </li>
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
                            <li class="active" aria-current="page"><span class="mr-1 mb-1 px-4 py-3 text-sm border rounded hover:bg-white focus:border-primary-500 focus:text-primary-500 bg-white">{{ $page }}</span></li>
                        @else
                            <li><a wire:click="gotoPage({{ $page }})" class="cursor-pointer mr-1 mb-1 px-4 py-3 text-sm border rounded hover:bg-white focus:border-primary-500 focus:text-primary-500">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a wire:click="nextPage" class="cursor-pointer mr-1 mb-1 px-4 py-3 text-sm border rounded hover:bg-white focus:border-primary-500 focus:text-primary-500 ml-auto" rel="next" aria-label="@lang('pagination.next')">
                        Selanjutnya
                    </a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="mr-1 mb-1 px-4 py-3 text-sm border rounded text-gray-400 ml-auto" aria-hidden="true">
                        Selanjutnya
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
