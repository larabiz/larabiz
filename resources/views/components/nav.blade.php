<nav {{ $attributes->merge(['class' => 'container flex items-center justify-between pt-4']) }}>
    <a href="{{ route('home') }}">
        <x-icon-larabiz class="h-8" />
    </a>

    <ul class="flex items-center gap-8 font-semibold">
        <li>
            <a href="{{ route('home') }}" class="@if (Route::is('home')) text-indigo-400 @else hover:text-indigo-400 transition-colors @endif">
                <x-heroicon-o-home class="w-5 h-5 -translate-y-[0.5px]" />
            </a>
        </li>

        <li>
            <a href="{{ route('posts.index') }}" class="@if (Route::is('posts.index') || Route::is('posts.show')) text-indigo-400 @else hover:text-indigo-400 transition-colors @endif">
                Blog
            </a>
        </li>
    </ul>
</nav>
