<div class="sm:relative -m-2" x-data="{ open: false }" @click.away="open = false" wire:poll.visible="fetchNotifications">
    <button
        class="block relative p-2 rounded-full"
        :class="{ 'bg-white/75': open }"
        @click="open = ! open; if (open) window.fathom?.trackGoal('PTZYINIB', 0)"
    >
        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 -translate-y-[0.5px]"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" /></svg>

        @if ($this->notifications->count())
            <span class="w-2 h-2 rounded-full bg-red-400 absolute top-2 right-2"></span>
        @endif
    </button>

    <div
        class="absolute top-full left-4 sm:left-auto right-4 sm:right-0 backdrop-blur-md bg-white/75
        sm:min-w-[400px] mt-2 rounded-lg shadow-xl shadow-indigo-900/10 z-10"
        x-show="open"
        x-transition
    >
        <div class="flex items-center justify-between px-4 py-3">
            <div class="font-bold text-sm">
                @choice(':count notification|:count notifications', $this->notifications->count())
            </div>

            @if ($this->notifications->count() > 0)
                <button
                    class="flex items-center font-bold text-indigo-400"
                    @click="$wire.markAllAsRead(); window.fathom?.trackGoal('7LNP2867', 0)"
                >
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                </button>
            @endif
        </div>

        @forelse ($this->notifications as $notification)
            <livewire:notifications.notification :notification="$notification" wire:key="notification-{{ $notification->id }}" />
        @empty
            <div class="border-t border-indigo-50 px-4 pb-6 pt-7 text-center text-black/30 text-sm">
                <x-icon-check class="fill-current h-12 inline" />
                <div class="mt-3">Aucune notification pour le moment.</div>
            </div>
        @endforelse
    </div>
</div>
