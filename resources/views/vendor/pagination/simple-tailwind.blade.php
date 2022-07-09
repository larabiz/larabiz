@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between mt-8">
        @if ($paginator->onFirstPage())
            <span class="flex items-center gap-2 font-bold opacity-50">
                <x-heroicon-o-arrow-left class="w-4 h-4" /> Previous
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="flex items-center gap-2 font-bold">
                <x-heroicon-o-arrow-left class="w-4 h-4" /> Previous
            </a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="flex items-center gap-2 font-bold">
                Next <x-heroicon-o-arrow-right class="w-4 h-4" />
            </a>
        @else
            <span class="flex items-center gap-2 font-bold opacity-50">
                Next <x-heroicon-o-arrow-right class="w-4 h-4" />
            </span>
        @endif
    </nav>
@endif
