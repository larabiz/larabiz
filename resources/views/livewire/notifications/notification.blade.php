<div class="border-t border-indigo-50 flex items-center gap-4 group p-4 text-sm transition-colors">
    <x-notifications.badge />

    <div>
        @if (str_contains($this->notification->type, 'NewExperienceGain'))
            <div class="block font-bold">
                @choice(':count point|:count points', $this->notification->data['points']) d'expérience gagnés.
            </div>

            <div class="block text-gray-500">
                « {{ $this->notification->data['message'] }} »
            </div>

            <div class="block mt-1 text-gray-400 text-xs transition-colors">
                {{ $this->notification->created_at->diffForHumans() }}
            </div>
        @else
            @if (! empty($this->notification->data['actionUrl']))
                <a href="{{ $this->notification->data['actionUrl'] }}">
            @else
                <div>
            @endif
                    <div class="block font-semibold">
                        {{ $this->notification->data['message'] }}
                    </div>

                    <div class="block mt-1 text-gray-400 text-xs transition-colors">
                        {{ $this->notification->created_at->diffForHumans() }}
                    </div>
            @if (! empty($this->notification->data['actionUrl']))
                </a>
            @else
                </div>
            @endif
        @endif
    </div>
</div>
