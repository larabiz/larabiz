<div class="border-t border-indigo-50 flex items-center gap-4 group p-4 text-sm transition-colors">
    <span class="flex-shrink-0 w-2 h-2 bg-indigo-400 rounded-full"></span>

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
