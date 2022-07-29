<x-app title='Commentaire de {{ $comment->user->username }} sur "{{ $comment->post->title }}"'>
    <div class="container py-8 sm:py-16">
        <nav class="mb-8 sm:mb-16">
            <a href="{{ route('posts.show', [$comment->post->random_id, $comment->post->slug]) }}#comments" class="inline-flex items-center gap-1 font-semibold text-indigo-400">
                <x-heroicon-o-arrow-left class="-mt-[.0625rem] h-4" /> {{ $comment->post->title }}
            </a>
        </nav>

        <livewire:comment :comment="$comment" :frameless="true" />
    </div>
</x-app>
