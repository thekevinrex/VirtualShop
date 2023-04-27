<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between px-4 py-3">
    <div class="flex justify-between flex-1 md:hidden">
        @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center px-4 py-2 text-xs sm:text-sm font-medium text-gray-500 bg-white border border-gray-300 dark:bg-neutral-700 dark:border-neutral-700 dark:text-white cursor-default leading-5 rounded-md">
                {{ trans('splade.previous') }}
            </span>
        @else
            <Link keep-modal dusk="pagination-simple-previous" href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 dark:bg-neutral-700 dark:border-neutral-700 dark:text-white text-xs sm:text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                {{ trans('splade.previous') }}
            </Link>
        @endif

        @includeWhen($hasPerPageOptions ?? true, 'splade::table.per-page-selector')

        @if ($paginator->hasMorePages())
            <Link keep-modal dusk="pagination-simple-next" href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 dark:bg-neutral-700 dark:border-neutral-700 dark:text-white text-xs sm:text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                {{ trans('splade.next') }}
            </Link>
        @else
            <span class="relative inline-flex dark:bg-neutral-700 dark:border-neutral-700 dark:text-white items-center px-4 py-2 text-xs sm:text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                {{ trans('splade.next') }}
            </span>
        @endif
    </div>

    <div class="hidden md:flex-1 md:flex md:items-center md:justify-between">
        
        <div>
            <span class="relative z-0 inline-flex shadow-sm rounded-md">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ trans('splade.previous') }}">
                        <span class="relative inline-flex items-center px-2 py-2 text-xs sm:text-sm font-medium text-gray-500 bg-white border border-gray-300 dark:bg-neutral-700 dark:border-neutral-700 cursor-default rounded-l-md leading-5" aria-hidden="true">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </span>
                @else
                    <Link keep-modal dusk="pagination-previous" href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex dark:bg-neutral-700 dark:border-neutral-700 items-center px-2 py-2 text-xs sm:text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="{{ trans('splade.previous') }}">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </Link>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span aria-disabled="true">
                            <span class="relative inline-flex items-center px-4 py-2 -ml-px text-xs sm:text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">{{ $element }}</span>
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page">
                                    <span class="relative inline-flex items-center px-4 py-2 -ml-px text-xs sm:text-sm font-medium bg-indigo-50 dark:bg-neutral-700 dark:text-white border-indigo-500 text-indigo-600 z-10 border cursor-default leading-5">{{ $page }}</span>
                                </span>
                            @else
                                <Link keep-modal dusk="pagination-{{ $page }}" href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 dark:bg-neutral-700 dark:border-neutral-700 dark:text-white -ml-px text-xs sm:text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="{{ trans('splade.go_to_page', ['page' => $page]) }}">
                                    {{ $page }}
                                </Link>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <Link keep-modal dusk="pagination-next" href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center dark:bg-neutral-700 dark:border-neutral-700 dark:text-white px-2 py-2 -ml-px text-xs sm:text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="{{ trans('splade.next') }}">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </Link>
                @else
                    <span aria-disabled="true" aria-label="{{ trans('splade.next') }}">
                        <span class="relative dark:bg-neutral-700 dark:border-neutral-700  dark:text-white inline-flex items-center px-2 py-2 -ml-px text-xs sm:text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-r-md leading-5" aria-hidden="true">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </span>
                @endif
            </span>
        </div>

        <div class="flex flex-row-reverse items-center">
            @includeWhen($hasPerPageOptions ?? true, 'splade::table.per-page-selector')

            <div class="hidden lg:block @if($hasPerPageOptions ?? true) mr-3 @endif">
                <p class="text-xs sm:text-sm text-black dark:text-white leading-5">
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        {{ trans('splade.to') }}
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {{ trans ('splade.of') }}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {{ trans('splade.results') }}
                </p>
            </div>
        </div>

    </div>
</nav>