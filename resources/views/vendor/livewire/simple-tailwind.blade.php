@if ($paginator->hasPages())
    <nav class="flex items-center justify-between mt-8">
        @if ($paginator->onFirstPage())
            <span class="flex items-center gap-2 font-normal opacity-30">
                <x-heroicon-o-arrow-left class="w-4 h-4" /> Précédent
            </span>
        @else
            @if (method_exists($paginator,'getCursorName'))
                <button dusk="previousPage" wire:click="setPage('{{$paginator->previousCursor()->encode()}}','{{ $paginator->getCursorName() }}')" wire:loading.attr="disabled" class="flex items-center gap-2 font-bold">
                    <x-heroicon-o-arrow-left class="w-4 h-4" /> Précédent
                </button>
            @else
                <button wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="flex items-center gap-2 font-bold">
                    <x-heroicon-o-arrow-left class="w-4 h-4" /> Précédent
                </button>
            @endif
        @endif

        @if ($paginator->hasMorePages())
            @if (method_exists($paginator,'getCursorName'))
                <button dusk="nextPage" wire:click="setPage('{{$paginator->nextCursor()->encode()}}','{{ $paginator->getCursorName() }}')" wire:loading.attr="disabled" class="flex items-center gap-2 font-bold">
                    Suivant <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>

                </button>
            @else
                <button wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="flex items-center gap-2 font-bold">
                    Suivant <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>

                </button>
            @endif
        @else
            <span class="flex items-center gap-2 font-normal opacity-30">
                Suivant <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>

            </span>
        @endif
    </nav>
@endif
