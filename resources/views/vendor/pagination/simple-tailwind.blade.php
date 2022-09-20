@if ($paginator->hasPages())
    <nav  class="flex items-center justify-between mt-8">
        @if ($paginator->onFirstPage())
            <span class="flex items-center gap-2 font-normal opacity-30">
                <x-heroicon-o-arrow-left class="w-4 h-4" /> Précédent
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="flex items-center gap-2 font-bold">
                <x-heroicon-o-arrow-left class="w-4 h-4" /> Précédent
            </a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="flex items-center gap-2 font-bold">
                Suivant <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>

            </a>
        @else
            <span class="flex items-center gap-2 font-normal opacity-30">
                Suivant <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>

            </span>
        @endif
    </nav>
@endif
