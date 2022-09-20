<a href="{{ route('posts.show', [$post->random_id, $post->slug]) }}" {{ $attributes->merge(['class' => 'bg-gradient-to-b from-white/50 to-white/30 flex items-center justify-between gap-4 sm:gap-6 px-4 py-6 sm:p-6 rounded-lg shadow-lg shadow-indigo-200/50']) }}>
    <div>
        <div class="font-bold leading-tight mb-3 text-indigo-900 text-lg sm:text-xl">
            {{ $post->title }}
        </div>

        @if (empty($hideExcerpt))
            <div class="-mt-1 line-clamp-3 sm:line-clamp-none mb-8 text-indigo-700/50">
                {{ $post->excerpt }}
            </div>
        @endif

        <div class="flex flex-wrap gap-x-6 sm:gap-x-8 gap-y-3 text-indigo-900/50 text-sm sm:text-base">
            <div class="flex items-center gap-2">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 translate-y-[-1.5px]"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>

                <strong class="text-indigo-900">{{ $post->status()->created_at->isoFormat('ll') }}</strong>
            </div>

            <div class="flex items-center gap-2">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 translate-y-[-1px]"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>

                <strong class="text-indigo-900">{{ $post->username }}</strong>
            </div>

            <div class="flex items-center gap-2">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 translate-y-[-0.5px]"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>

                <strong class="text-indigo-900">{{ $post->read_time }} min</strong>
            </div>

            <div class="flex items-center gap-2">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 translate-y-[-1px]"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" /></svg>

                @choice('<strong class="text-indigo-900">:count commentaire</strong>|<strong class="text-indigo-900">:count commentaires</strong>', $post->comments_count)
            </div>
        </div>
    </div>

    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-indigo-300/50"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
</a>
