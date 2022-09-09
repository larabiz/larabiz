<div x-data="{ open: false }">
    <button class="fixed bottom-4 left-1/2 -translate-x-1/2 bg-black/75 backdrop-blur-md flex items-center justify-center md:hidden rounded-full text-white w-12 h-12 z-20" @click="open = ! open">
        <x-heroicon-o-list-bullet class="w-6 h-6" x-show="! open" />
        <x-heroicon-o-x-mark class="w-6 h-6" x-show="open" />
        <span class="sr-only">Table des matières</span>
    </button>

    <nav class="fixed md:static inset-0 md:inset-auto backdrop-blur-md bg-black/75 md:bg-transparent md:!block overflow-y-scroll md:overflow-y-auto p-4 md:p-0 pb-20 md:pb-0 text-white md:text-current" x-show="open" x-transition>
        <p class="font-bold">Table des matières</p>

        <ul class="list-disc ml-4 mt-4 pl-4">
            @foreach ($post->table_of_contents as $heading)
                <li>
                    <a
                        href="#{{ str($heading['title'])->slug }}"
                        class="text-indigo-200 md:text-indigo-400"
                        @click="open = false"
                    >
                        {{ $heading['title'] }}
                    </a>

                    <x-toc-children :children="$heading['children']" />
                </li>
            @endforeach
        </ul>
    </nav>
</div>
