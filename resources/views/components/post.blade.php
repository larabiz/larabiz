<a href="{{ route('posts.show', [$post->random_id, $post->slug]) }}" {{ $attributes->merge(['class' => 'bg-gradient-to-b from-white/50 to-white/30 flex items-center justify-between gap-4 sm:gap-6 px-4 py-6 sm:p-6 rounded-lg shadow-lg shadow-indigo-200/50']) }}>
    <div>
        <div class="font-bold leading-tight text-indigo-900 text-lg sm:text-xl">
            {{ $post->title }}
        </div>

        <div class="line-clamp-3 sm:line-clamp-none mt-2 text-indigo-700/50">
            {{ $post->excerpt }}
        </div>

        <div class="flex flex-wrap gap-x-6 sm:gap-x-8 gap-y-3 mt-8 text-indigo-900/50 text-sm sm:text-base">
            <div class="flex items-center gap-2">
                <x-heroicon-o-calendar class="h-5 translate-y-[-1.5px]" />
                <strong class="text-indigo-900">{{ $post->status()->created_at->isoFormat('ll') }}</strong>
            </div>

            <div class="flex items-center gap-2">
                <x-heroicon-o-user class="h-5 translate-y-[-1px]" />
                <strong class="text-indigo-900">{{ $post->username }}</strong>
            </div>

            <div class="flex items-center gap-2">
                <x-heroicon-o-clock class="h-5 translate-y-[-0.5px]" />
                <strong class="text-indigo-900">{{ $post->read_time }} min</strong>
            </div>

            <div class="flex items-center gap-2">
                <x-heroicon-o-chat-bubble-left-right class="h-5 translate-y-[-1px]" />
                @choice('<strong class="text-indigo-900">:count commentaire</strong>|<strong class="text-indigo-900">:count commentaires</strong>', $post->comments_count)
            </div>
        </div>
    </div>

    <x-heroicon-o-chevron-right class="h-5 text-indigo-300/50" />
</a>
