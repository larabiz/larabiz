<div {{ $attributes->merge(['class' => 'absolute top-full left-4 sm:left-auto right-4 sm:right-0 backdrop-blur-md bg-white/75 sm:min-w-[400px] mt-2 rounded-lg shadow-xl shadow-indigo-900/10 z-10']) }} x-transition>
    <div class="flex items-center justify-between px-4 py-3">
        <div class="font-bold text-sm">
            @choice(':count notification|:count notifications', $count)
        </div>

        @if ($count > 0)
            <x-form method="POST" action="{{ route('user.mark-all-notifications-as-read') }}">
                <button type="submit" class="flex items-center font-bold text-indigo-400">
                    <span class="sr-only">@choice('Marquer comme lue|Marquer comme lues', $count)</span>
                    <x-heroicon-o-check class="h-5" />
                </button>
            </x-form>
        @endif
    </div>

    @forelse (auth()->user()->unreadNotifications as $notification)
        <x-notification :notification="$notification" />
    @empty
        <div class="border-t border-indigo-50 px-4 pb-6 pt-7 text-center text-black/30 text-sm">
            <x-icon-check class="fill-current h-12 inline" />
            <div class="mt-3">Aucune notification pour le moment.</div>
        </div>
    @endforelse
</div>
