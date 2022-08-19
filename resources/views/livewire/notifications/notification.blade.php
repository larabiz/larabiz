<div class="border-t border-indigo-50 flex items-center gap-4 group p-4 text-sm transition-colors">
    <x-notifications.badge />

    <div>
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
    </div>
</div>
