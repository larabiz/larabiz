<div wire:poll.visible>
    <h2 class="font-extrabold leading-tight mb-8 sm:mb-16 text-center text-xl">
        @choice(':count commentaire|:count commentaires', $this->post->comments_count)
    </h2>

    <div class="grid gap-4">
        @foreach ($this->comments as $comment)
            <livewire:comments.comment
                :comment="$comment"
                :key="`comment-{{ $comment->id }}`"
            />
        @endforeach
    </div>
</div>
