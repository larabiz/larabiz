<div class="bg-white bg-opacity-[.35] flex flex-col relative rounded-3xl shadow-lg shadow-indigo-200/50">
    @if ($url = $post->getFirstMediaUrl('illustration', 'large'))
        <a href="{{ route('posts.show', [$post->random_id, $post->slug]) }}">
            <img loading="lazy" src="{{ $url }}" alt="" class="aspect-video object-cover rounded-3xl w-full" />
        </a>
    @endif

    @if ($post->is_draft || $post->certified_for_laravel)
        <div class="absolute -top-2 left-0 right-0 flex items-center justify-center gap-2">
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

        <div class="flex-grow mt-2 text-indigo-900/75">
            {{ $post->excerpt }}
        </div>

        <div class="flex flex-wrap gap-x-6 gap-y-2 mt-6 text-indigo-900/50">
            <div class="flex items-center gap-2">
                <x-heroicon-o-user class="h-5 translate-y-[-1px]" />
                <strong class="text-indigo-900">{{ $post->username }}</strong>
            </div>

            <div class="flex items-center gap-2">
                <x-heroicon-o-calendar class="h-5 translate-y-[-1.5px]" />
                <strong class="text-indigo-900">{{ $post->created_at->isoFormat('ll') }}</strong>
            </div>

            <a
                href="{{ route('posts.show', [$post->random_id, $post->slug]) }}#comments"
                class="flex items-center gap-2"
            >
                <x-heroicon-o-chat class="h-5 translate-y-[-1px]" />
                @choice('<strong class="text-indigo-900">:count commentaire</strong>|<strong class="text-indigo-900">:count commentaires</strong>', $post->comments_count)
            </a>
        </div>
    </div>
</div>
