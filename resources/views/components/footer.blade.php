<div {{ $attributes->merge(['class' => 'bg-gray-900 dark:bg-black py-8 text-gray-400 text-sm']) }}>
    <footer class="container sm:max-w-screen-sm text-center">
        <a href="{{ route('home') }}">
            <x-icon-larabiz-alt class="h-6 sm:h-7 inline" />
        </a>

        <p class="mt-6 sm:mt-8">
            Sur {{ config('app.name') }}, apprenez PHP et Laravel en français. Retrouvez les dernières
            offres d'emploi, des articles de qualité et plus encore.
        </p>

        <ul class="flex flex-wrap sm:flex-nowrap items-center justify-center gap-2 mt-5 sm:mt-7">
            <li>
                <a href="{{ route('posts.index') }}" class="text-gray-300 hover:text-white transition-colors">Blog</a>
            </li>

            <li class=" text-gray-600 text-xs">•</li>

            <li>
                <a href="{{ route('about') }}" class="text-gray-300 hover:text-white transition-colors">À propos</a>
            </li>

            <li class=" text-gray-600 text-xs">•</li>

            <li>
                <a href="{{ route('community') }}" class="text-gray-300 hover:text-white transition-colors">Communauté</a>
            </li>

            <li class=" text-gray-600 text-xs">•</li>

            <li>
                <a href="{{ route('uses') }}" class="text-gray-300 hover:text-white transition-colors">Mon équipement</a>
            </li>
        </ul>

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
