<li class="first:hidden">
    <x-heroicon-o-chevron-right class="h-4 text-indigo-300/50" />
</li>

<li class="group last:truncate">
    @if (! empty($link))
        <a href="{{ $link }}" class="text-indigo-400 transition-colors">
            {{ $slot }}
        </a>
    @else
        <span class="font-light">{{ $slot }}</span>
    @endif
</li>
