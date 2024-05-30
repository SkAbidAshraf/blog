@if ($paginator->hasPages())
    <nav aria-label="Page navigation" class="flex justify-center order-last">
        <ul class="inline-flex space-x-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <button
                        class="flex items-center justify-center w-10 h-10 text-blue-700 transition-colors duration-150 rounded-full focus:shadow-outline cursor-default hover:bg-blue-100"
                        disabled>
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                            <path
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </li>
            @else
                <li>
                    <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" onclick="scrollToTop()"
                        class="flex items-center justify-center w-10 h-10 text-blue-700 transition-colors duration-150 rounded-full focus:shadow-outline hover:bg-blue-100">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                            <path
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li>
                        <button
                            class="w-10 h-10 text-blue-700 transition-colors duration-150 rounded-full focus:shadow-outline hover:bg-blue-100 cursor-default no-underline">{{ $element }}</button>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <button
                                    class="w-10 h-10 text-white transition-colors duration-150 bg-blue-700 border border-r-0 border-blue-700 rounded-full focus:shadow-outline">{{ $page }}</button>
                            </li>
                        @else
                            <li>
                                <button wire:click="gotoPage({{ $page }})" onclick="scrollToTop()"
                                    class="w-10 h-10 text-blue-700 transition-colors duration-150 rounded-full focus:shadow-outline hover:bg-blue-100">{{ $page }}</button>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" onclick="scrollToTop()"
                        class="flex items-center justify-center w-10 h-10 text-blue-700 transition-colors duration-150 rounded-full focus:shadow-outline hover:bg-blue-100">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                            <path
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>

                </li>
            @else
                <li>
                    <button
                        class="flex items-center justify-center w-10 h-10 text-blue-700 transition-colors duration-150 rounded-full focus:shadow-outline cursor-default hover:bg-blue-100"
                        disabled>
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                            <path
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </li>
            @endif
        </ul>
    </nav>
@endif


@if ($paginator->total() > 0)
    <p class="text-sm flex justify-center my-3 text-blue-600">Showing {{ $paginator->firstItem() }} to
        {{ $paginator->lastItem() }} of {{ $paginator->total() }} results</p>
@endif
