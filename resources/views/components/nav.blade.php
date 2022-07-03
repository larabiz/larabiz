<nav {{ $attributes->merge(['class' => 'container flex items-center justify-between pt-4']) }}>
    <a href="{{ route('home') }}">
        <x-icon-larabiz class="h-8" />
    </a>

    <ul class="flex items-center gap-8 font-semibold text-indigo-900">
        <li>
            <a href="#" class="hover:text-indigo-400 transition-colors">
                Offres
            </a>
        </li>

        <li>
            <a href="{{ route('posts.index') }}" class="@if (Route::is('posts.index') || Route::is('posts.show')) text-indigo-400 @else hover:text-indigo-400 transition-colors @endif">
                Blog
            </a>
        </li>

        <li>
            <a href="#" class="hover:text-indigo-400 transition-colors">
                Discussions
            </a>
        </li>

        <li>
            <a href="https://twitter.com/Larabiz_" target="_blank" rel="noopener noreferrer" class="hover:text-indigo-400 transition-colors">
                Twitter
            </a>
        </li>
    </ul>
</nav>
