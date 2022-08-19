<a href="{{ route('posts.show', [$post->random_id, $post->slug]) }}" class="border-t first:border-t-0 border-black/5 flex items-center justify-between gap-8 pt-8 first:pt-0">
    <span>
        <span class="font-bold leading-tight text-indigo-900 text-lg sm:text-xl">
            {{ $post->title }}
        </span>

        <span class="flex flex-wrap gap-x-6 sm:gap-x-8 gap-y-2 mt-4 md:mt-2 text-indigo-900/50 text-sm sm:text-base">
            <span class="flex items-center gap-2">
                <x-heroicon-o-calendar class="h-5 translate-y-[-1.5px]" />
                <strong class="text-indigo-900">{{ $post->latestStatus()->created_at->isoFormat('ll') }}</strong>
            </span>

            <span class="flex items-center gap-2">
                <x-heroicon-o-user class="h-5 translate-y-[-1px]" />
                <strong class="text-indigo-900">{{ $post->username }}</strong>
            </span>

            <span class="flex items-center gap-2">
                <x-heroicon-o-clock class="h-5 translate-y-[-1.5px]" />
                <strong class="text-indigo-900">{{ $post->read_time }} min</strong>
            </span>

            <span class="flex items-center gap-2">
                <x-heroicon-o-chat class="h-5 translate-y-[-1px]" />
                @choice('<strong class="text-indigo-900">:count commentaire</strong>|<strong class="text-indigo-900">:count commentaires</strong>', $post->comments_count)
            </span>
        </span>
    </span>

    <x-heroicon-o-chevron-right class="h-5 text-indigo-300/50" />
</a>
