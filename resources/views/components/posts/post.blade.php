<div class="bg-white/30 dark:bg-gray-800 flex flex-col h-full rounded-3xl shadow-lg shadow-indigo-200/50 dark:shadow-none">
    @if ($url = $post->getFirstMediaUrl('illustration', 'large'))
        <a href="{{ route('posts.show', [$post->random_id, $post->slug]) }}">
            <img loading="lazy" src="{{ $url }}" alt="" class="aspect-video object-cover rounded-3xl w-full" />
        </a>
    @endif

    <div class="flex flex-col flex-grow px-4 py-6 sm:p-6">
        <h2 class="font-bold leading-tight text-indigo-900 dark:text-indigo-100 text-xl">
            <a href="{{ route('posts.show', [$post->random_id, $post->slug]) }}">
                {{ $post->title }}
            </a>
        </h2>

        <p class="flex-grow mt-2 text-indigo-900/75 dark:text-indigo-200/80">
            {{ $post->excerpt }}
        </p>

        <div class="flex flex-wrap gap-x-6 gap-y-2 mt-6 text-indigo-900/50 dark:text-indigo-400/90">
            <p class="flex items-center gap-2">
                <x-heroicon-o-user class="h-5 translate-y-[-1px]" />
                <strong class="text-indigo-900 dark:text-indigo-300">{{ $post->username }}</strong>
            </p>

            <p class="flex items-center gap-2">
                <x-heroicon-o-calendar class="h-5 translate-y-[-1.5px]" />
                <strong class="text-indigo-900 dark:text-indigo-300">{{ $post->latestStatus()->created_at->isoFormat('ll') }}</strong>
            </p>

            <a
                href="{{ route('posts.show', [$post->random_id, $post->slug]) }}#comments"
                class="flex items-center gap-2"
            >
                <x-heroicon-o-chat class="h-5 translate-y-[-1px]" />
                @choice('<strong class="text-indigo-900 dark:text-indigo-300">:count commentaire</strong>|<strong class="text-indigo-900 dark:text-indigo-300">:count commentaires</strong>', $post->comments_count)
            </a>
        </div>
    </div>
</div>
