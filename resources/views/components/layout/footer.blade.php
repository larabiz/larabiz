<div {{ $attributes->merge(['class' => 'bg-gray-900 py-8 text-gray-400 text-sm']) }}>
    <footer class="container">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}">
                <x-icon-larabiz-alt class="h-6 sm:h-7 inline" />
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
            </ul>
        </div>

        <p class="mt-8 text-center">
            Site hébergé sur <a href="https://m.do.co/c/58bbdf89fc72" target="_blank" rel="nofollow noopener" class="text-gray-200">DigitalOcean</a>. Télémétrie par <a href="https://usefathom.com/ref/JTPOCN" target="_blank" rel="nofollow noopener" class="text-gray-200">Fathom Analytics</a>.
        </p>
    </footer>
</div>
