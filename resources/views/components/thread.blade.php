<div class="bg-gradient-to-b from-white/50 to-white/30 p-4 md:p-6 rounded-xl shadow-md shadow-indigo-100">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <img
                loading="lazy"
                src="https://www.gravatar.com/avatar/{{ md5($thread->user_email) }}?s=144"
                width="21"
                height="21"
                class="flex-shrink-0 rounded-full"
            />

            <div class="font-bold">{{ $thread->username }}</div>
        </div>

        <span class="text-indigo-300 text-xs">{{ $thread->created_at->diffForHumans(short: true) }}</span>
    </div>

    <a href="{{ route('threads.show', [$thread->random_id, $thread->slug]) }}" class="font-bold inline-block mt-4 text-xl">
        {{ $thread->title }}
    </a>

    <div class="flex items-center justify-between mt-10 text-sm">
        @if ($thread->last_reply_created_at)
            <div class="flex items-center gap-2">
                <x-heroicon-o-arrow-uturn-right class="h-4 -translate-y-[1.5px]" />

                <span>
                    <span class="font-bold">{{ $thread->last_reply_username }}</span>
                    {{ $thread->last_reply_created_at->diffForHumans(short: true) }}
                </span>
            </div>
        @else
            <div>Aucune réponse pour le moment.</div>
        @endif

        @if ($thread->replies_count)
            <div class="flex items-center gap-2 font-bold">
                <x-heroicon-o-chat-bubble-bottom-center class="h-4 -translate-y-[1px]" />
                {{ $thread->replies_count }}
            </div>
        @endif
    </div>
</div>
