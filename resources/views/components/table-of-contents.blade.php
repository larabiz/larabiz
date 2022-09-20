<nav class="mt-8" x-data="{ open: false }">
    <p class="font-bold">Table des matières</p>

    @if ($tableOfContents = $post->table_of_contents)
        <ol class="grid gap-4 mt-4">
            @foreach ($tableOfContents as $item)
                <li
                    class="flex items-center gap-3 ml-{{ $item['level'] - 1 * 4 }} text-indigo-900/75"
                    style="margin-left: calc(1rem * {{ $item['level'] - 1 }})"
                    @if ($loop->index > 5) x-show="open" @endif
                >
                    <span class="bg-indigo-100/75 flex flex-shrink-0 items-center justify-center font-normal rounded-full text-xs w-6 h-6">
                        {{ $loop->index + 1 }}
                    </span>

                    <a href="#{{ $item['id'] }}" @click="window.fathom?.trackGoal('V9WUVWRI', 0)">
                        {{ $item['title'] }}
                    </a>
                </li>
            @endforeach
        </ol>

        @if (count($tableOfContents) > 6)
            <button class="flex items-center gap-2 font-normal mt-4 text-sm" @click="open = ! open; window.fathom?.trackGoal('HY42RWS8', 0)">
                <span x-show="! open">Il y en a encore plus</span>

                <span x-show="open">Cacher</span>

                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 transition" x-bind:class="{ 'rotate-180': open }"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
            </button>
        @endif
    @endif
</nav>
