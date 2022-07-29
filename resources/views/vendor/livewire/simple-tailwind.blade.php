@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between mt-8">
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
                    Suivant <x-heroicon-o-arrow-right class="w-4 h-4" />
                </button>
            @else
                <button wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="flex items-center gap-2 font-bold">
                    Suivant <x-heroicon-o-arrow-right class="w-4 h-4" />
                </button>
            @endif
        @else
            <span class="flex items-center gap-2 font-normal opacity-30">
                Suivant <x-heroicon-o-arrow-right class="w-4 h-4" />
            </span>
        @endif
    </nav>
@endif
