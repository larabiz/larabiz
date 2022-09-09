<div x-data="{ open: false }">
    <button class="fixed bottom-4 left-1/2 -translate-x-1/2 bg-black/75 backdrop-blur-md flex items-center justify-center md:hidden rounded-full text-white w-12 h-12 z-20" @click="open = ! open">
        <x-heroicon-o-list-bullet class="w-6 h-6" x-show="! open" />
        <x-heroicon-o-x-mark class="w-6 h-6" x-show="open" />
        <span class="sr-only">Table des matières</span>
    </button>

    <nav
        class="fixed md:static inset-0 md:inset-auto backdrop-blur-md bg-white/50 md:bg-transparent md:!block overflow-y-scroll md:overflow-y-auto p-4 pb-20
        md:bg-indigo-100/50 md:p-6 md:rounded"
        x-show="open"
        x-transition
    >
        <p class="font-bold">Table des matières</p>

        <ul class="mt-4">
            @foreach ($post->table_of_contents as $heading)
                <li class="mt-1">
                    <a
                        href="#{{ str($heading['title'])->slug }}"
                        class="flex items-center gap-2 font-bold text-indigo-400"
                        @click="open = false"
                    >
                        <x-icon-circle class="fill-current flex-shrink-0 text-indigo-300 w-[5px] h-[5px] -translate-y-[.5px]" />
                        {{ $heading['title'] }}
                    </a>

                    <x-toc-children :children="$heading['children']" />
                </li>
            @endforeach
        </ul>
    </nav>
</div>
