<div {{ $attributes->merge(['class' => 'bg-gray-900 py-8 text-gray-400 text-sm']) }}>
    <footer class="container sm:max-w-screen-sm text-center">
        <a href="{{ route('home') }}">
            <x-icon-larabiz-alt class="h-6 sm:h-7 inline" />
        </a>

        <p class="mt-6 sm:mt-8">Sur {{ config('app.name') }}, retrouvez par mail les dernières offres d'emploi Laravel, des articles de qualité et plus encore.</p>

        <ul class="flex items-center justify-center gap-2 mt-7 sm:mt-9 text-gray-300">
            <li>
                <a href="https://github.com/Larabiz">
                    <span class="sr-only">GitHub</span>
                    <x-icon-github class="fill-current h-8" />
                </a>
            </li>

            <li>
                <a href="https://twitter.com/Larabiz_">
                    <span class="sr-only">Twitter</span>
                    <x-icon-twitter class="fill-current h-8" />
                </a>
            </li>
        </ul>
    </footer>
</div>
