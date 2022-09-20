<li class="first:hidden">
    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-indigo-300/50"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
</li>

<li {{ $attributes->merge(['class' => 'group last:truncate']) }}>
    @if (! empty($link))
        <a href="{{ $link }}" class="text-indigo-400 transition-colors">
            {{ $slot }}
        </a>
    @else
        <span class="font-light">{{ $slot }}</span>
    @endif
</li>
