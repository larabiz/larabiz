@if ($paginator->hasPages())
    @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)

    <nav
        class="flex items-center justify-between my-8"
    >
        @if ($paginator->onFirstPage())
            <span class="opacity-20">
                <x-heroicon-o-arrow-left class="w-4 h-4" />
            </span>
        @else
            <button
                @click="$wire.previousPage('{{ $paginator->getPageName() }}'); document.getElementById('comments').scrollIntoView({ behavior: 'smooth' })"
                dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
                rel="prev"
            >
                <x-heroicon-o-arrow-left class="w-4 h-4" />
            </button>
        @endif

        {{-- Pagination Elements --}}
        <div>
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span>
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                <div class="flex items-center justify-center gap-2">
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <span wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page{{ $page }}">
                                @if ($page == $paginator->currentPage())
                                    <span
                                        class="bg-white flex font-bold items-center justify-center
                                        rounded-full text-sm sm:text-base w-8 sm:w-10 h-8 sm:h-10"
                                    >
                                        {{ $page }}
                                    </span>
                                @else
                                    <button
                                        wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                        class="flex font-bold items-center justify-center rounded-full
                                        text-indigo-400 text-sm sm:text-base w-8 sm:w-10 h-8 sm:h-10"
                                    >
                                        {{ $page }}
                                    </button>
                                @endif
                            </span>
                        @endforeach
                    @endif
                </div>
            @endforeach
        </div>

        @if ($paginator->hasMorePages())
            <button
                rel="next"
                dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
                @click="$wire.nextPage('{{ $paginator->getPageName() }}'); document.getElementById('comments').scrollIntoView({ behavior: 'smooth' })"
            >
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>

            </button>
        @else
            <span class="opacity-20">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>

            </span>
        @endif
    </nav>
@endif
