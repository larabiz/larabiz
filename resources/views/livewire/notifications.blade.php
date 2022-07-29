<div class="sm:relative -m-2" x-data="{ open: false }" @click.away="open = false" wire:poll="fetchNotifications">
    <button
        class="block relative p-2 rounded-full"
        :class="{ 'bg-white/75': open }"
        @click="open = ! open; if (open) window.fathom?.trackGoal('PTZYINIB', 0)"
    >
        <x-heroicon-o-bell class="w-5 h-5 -translate-y-[0.5px]" />

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
                    <x-heroicon-o-check class="h-5" />
                </button>
            @endif
        </div>

        @forelse ($this->notifications as $notification)
            <livewire:notification :notification="$notification" wire:key="notification-{{ $notification->id }}" />
        @empty
            <div class="border-t border-indigo-50 px-4 pb-6 pt-7 text-center text-black/30 text-sm">
                <x-icon-check class="fill-current h-12 inline" />
                <div class="mt-3">Aucune notification pour le moment.</div>
            </div>
        @endforelse
    </div>
</div>
