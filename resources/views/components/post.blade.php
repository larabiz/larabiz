<a href="{{ route('posts.show', [$post->id, $post->slug]) }}" class="bg-white bg-opacity-[.35] flex flex-col rounded-3xl shadow-lg shadow-indigo-200/50">
    <div class="bg-black aspect-video object-cover rounded-3xl"></div>

    <div class="flex flex-col flex-grow p-6">
        <div class="font-bold leading-tight text-indigo-900 text-xl">
            {{ $post->title }}
        </div>

        <div class="flex-grow line-clamp-2 mt-2 text-indigo-900/75">
            {{ $post->excerpt }}
        </div>

        <div class="mt-6 text-indigo-900/50">
            par <strong class="text-indigo-900">{{ $post->user->name }}</strong> le <strong class="text-indigo-900">{{ $post->updated_at->isoFormat('ll') }}</strong>
        </div>
    </div>
</a>
