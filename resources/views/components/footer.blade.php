<div {{ $attributes->merge(['class' => 'bg-gray-900 py-8 text-gray-400 text-sm']) }}>
    <footer class="container">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}">
                <x-icon-larabiz-alt class="h-6 md:h-7 inline" />
            </a>

            <ul class="flex items-center justify-center gap-2 text-gray-300">
                <li>
                    <a href="https://github.com/Larabiz" target="_blank" rel="nofollow noopener">
                        <span class="sr-only">GitHub</span>
                        <x-icon-github class="fill-current h-8" />
                    </a>
                </li>

                <li>
                    <a href="https://twitter.com/Larabiz_" target="_blank" rel="nofollow noopener">
                        <span class="sr-only">Twitter</span>
                        <x-icon-twitter class="fill-current h-8" />
                    </a>
                </li>

                <li>
                    <a href="https://www.youtube.com/channel/UCfoiljAxlMCtf6Ij2V0R2FA" target="_blank" rel="nofollow noopener">
                        <span class="sr-only">YouTube</span>
                        <x-icon-youtube class="fill-current h-8" />
                    </a>
                </li>
            </ul>
        </div>

        <p class="font-bold mt-8 text-gray-300">Retrouvez le reste de la communauté</p>

        <ul class="flex flex-wrap items-center gap-2 mt-2">
            <li><a href="https://www.youtube.com/channel/UCEvgUSS6r70F0cFcYkJ5MpQ" class="hover:text-white transition-colors">HappyToDev</a></li>
            <li class="text-xs">•</li>
            <li><a href="https://laravel.cm" class="hover:text-white transition-colors">Laravel Cameroun</a></li>
            <li class="text-xs">•</li>
            <li><a href="https://laravel-france.com" class="hover:text-white transition-colors">Laravel France</a></li>
            <li class="text-xs">•</li>
            <li><a href="https://nordcoders.fr" class="hover:text-white transition-colors">NordCoders</a></li>
            <li class="text-xs">•</li>
            <li><a href="https://www.tutomarks.fr" class="hover:text-white transition-colors">Tutomarks</a></li>
        </ul>

        <p class="mt-8 text-center">
            Site hébergé sur <a href="https://m.do.co/c/58bbdf89fc72" target="_blank" rel="nofollow noopener" class="text-gray-200 hover:text-white transition-colors">DigitalOcean</a>. Télémétrie par <a href="https://usefathom.com/ref/JTPOCN" target="_blank" rel="nofollow noopener" class="text-gray-200 hover:text-white transition-colors">Fathom&nbsp;Analytics</a>.
        </p>
    </footer>
</div>
