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
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 -translate-y-[1.5px]"><path stroke-linecap="round" stroke-linejoin="round" d="M15 15l6-6m0 0l-6-6m6 6H9a6 6 0 000 12h3" /></svg>

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
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 -translate-y-[1px]"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" /></svg>

                {{ $thread->replies_count }}
            </div>
        @endif
    </div>
</div>
