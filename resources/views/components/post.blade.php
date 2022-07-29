<div class="bg-white bg-opacity-[.35] flex flex-col relative rounded-3xl shadow-lg shadow-indigo-200/50">
    @if ($url = $post->getFirstMediaUrl('illustration', 'large'))
        <a href="{{ route('posts.show', [$post->random_id, $post->slug]) }}">
            <img src="{{ $url }}" alt="" class="aspect-video object-cover rounded-3xl w-full" />
        </a>
    @endif

    @if ($post->is_draft || $post->certified_for_laravel)
        <div class="absolute -top-2 left-1/2 -translate-x-1/2 flex items-center gap-2">
            @if ($post->is_draft)
                <span class="bg-gradient-to-b from-gray-700 to-gray-800 font-black px-4 py-2 rounded-full shadow-md text-xs text-white uppercase">
                    Brouillon
                </span>
            @endif

            @if ($post->certified_for_laravel)
                <span class="bg-gradient-to-b from-red-500 to-red-600 font-black px-4 py-2 rounded-full shadow-md shadow-red-900/10 text-xs text-white uppercase">
                    Laravel {{ $post->certified_for_laravel }}
                </span>
            @endif
        </div>
    @endif

    <div class="flex flex-col flex-grow px-4 py-6 sm:p-6">
        <div class="font-bold leading-tight text-indigo-900 text-xl">
            <a href="{{ route('posts.show', [$post->random_id, $post->slug]) }}">
                {{ $post->title }}
            </a>
        </div>

        <div class="flex-grow line-clamp-2 mt-2 text-indigo-900/75">
            {{ $post->excerpt }}
        </div>

        <div class="grid grid-cols-2 gap-1 mt-6 text-indigo-900/50">
            <div class="flex items-center gap-2">
                <x-heroicon-o-user class="h-5 translate-y-[-1px]" />
                <strong class="text-indigo-900">{{ $post->user->username }}</strong>
            </div>

            <div class="flex items-center gap-2 mt-1">
                <x-heroicon-o-calendar class="h-5 translate-y-[-1.5px]" />
                <strong class="text-indigo-900">{{ $post->updated_at->isoFormat('ll') }}</strong>
            </div>

            <a
                href="{{ route('posts.show', [$post->random_id, $post->slug]) }}#comments"
                class="flex items-center gap-2"
            >
                <x-heroicon-o-chat class="h-5 translate-y-[-1px]" />
                @choice('<strong class="text-indigo-900">:count</strong> commentaire|<strong class="text-indigo-900">:count</strong> commentaires', $post->comments_count)
            </a>
        </div>
    </div>
</div>
