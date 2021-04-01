@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700 leading-5">
                    {!! __('Showing') !!}
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">

                </span>
            </div>
        </div>
    </nav>

    <ul class="pagination m-0">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true">
                <a class="page-link" href="javascript:void(0)" aria-label="Prev">
                    <span aria-hidden="true" class="material-icons">chevron_left</span>
                    <span>Prev</span>
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Prev">
                    <span aria-hidden="true" class="material-icons">chevron_left</span>
                    <span>Prev</span>
                </a>
            </li>
        @endif


        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span aria-disabled="true">
                    <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">{{ $element }}</span>
                </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page">
                            <a class="page-link" href="{{ $url }}" aria-label="{{ $page }}">
                                <span>{{ $page }}</span>
                            </a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                <span>{{ $page }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach




        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next" rel="Next">
                    <span>Next</span>
                    <span aria-hidden="true" class="material-icons">chevron_right</span>
                </a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true">
                <a class="page-link" href="javascript:void(0)" aria-label="Next">
                    <span>Next</span>
                    <span aria-hidden="true" class="material-icons">chevron_right</span>
                </a>
            </li>
        @endif
    </ul>
@endif