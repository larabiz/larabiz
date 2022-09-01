<x-app>
    <x-breadcrumb class="container mt-8 sm:mt-16">
        <x-breadcrumb-item link="{{ route('threads.index') }}">Forum</x-breadcrumb-item>
        <x-breadcrumb-item>{{ $thread->title }}</x-breadcrumb-item>
    </x-breadcrumb>

    <div class="container grid py-8 sm:py-16">
        <div class="bg-gradient-to-b from-white/50 to-white/30 px-4 py-6 sm:p-6 rounded-lg shadow-lg shadow-indigo-200/50">
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

                <span class="text-indigo-300 text-xs">{{ $thread->created_at->diffForHumans() }}</span>
            </div>

            <h1 class="font-bold inline-block mt-4 text-xl">
                {{ $thread->title }}
            </h1>

            <div class="mt-4">
                {{ $thread->content }}
            </div>
        </div>

        <div class="bg-indigo-200/50 mx-auto w-px h-8 sm:h-16"></div>

        <div class="bg-gradient-to-b from-gray-800 to-gray-600 cursor-default font-bold leading-none mx-auto px-4 py-2 rounded-full table text-xs text-white">@choice(':count réponse|:count réponses', $thread->replies_count)</div>

        <div class="bg-indigo-200/50 mx-auto w-px h-8 sm:h-16"></div>

        @foreach ($replies as $reply)
            <div class="bg-gradient-to-b from-white/50 to-white/30 px-4 py-6 sm:p-6 rounded-lg shadow-lg shadow-indigo-200/50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <img
                            loading="lazy"
                            src="https://www.gravatar.com/avatar/{{ md5($reply->user->email) }}?s=144"
                            width="21"
                            height="21"
                            class="flex-shrink-0 rounded-full"
                        />

                        <div class="font-bold">{{ $reply->user->username }}</div>
                    </div>

                    <span class="text-indigo-300 text-xs">{{ $reply->created_at->diffForHumans() }}</span>
                </div>

                <div class="mt-4">
                    {{ $reply->content }}
                </div>
            </div>

            @if (! $loop->last)
                <div class="bg-indigo-200/50 mx-auto w-px h-4"></div>
            @endif
        @endforeach

        {{ $replies->links() }}

        @auth
            <div class="bg-indigo-200/50 mx-auto w-px h-8 sm:h-16"></div>

            <x-form
                method="POST"
                action="#"
                class="grid gap-8"
            >
                <div class="bg-white/75 rounded shadow shadow-indigo-100 transition-colors" :class="{ 'bg-white': focused }">
                    <x-markdown />

                    <div class="pb-4 px-4 text-right">
                        <x-action-btn type="submit" class="shadow-md w-full">
                            Répondre
                        </x-action-btn>
                    </div>
                </div>
            </x-form>
        @endauth
    </div>
</x-app>
