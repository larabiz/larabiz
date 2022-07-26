<div {{ $attributes->merge(['class' => 'bg-gray-900 py-8 text-gray-400']) }}>
    <footer class="container">
        <p class="mt-4">{{ config('app.name') }} est un site ayant pour mission d'accompagner les développeurs Laravel francophones. Lisez le blog et abonnez-vous à la newsletter afin de recevoir les dernières offres d'emploi et plus encore.</p>

        <div class="grid grid-cols-2 gap-8 mt-8">
            <nav>
                <p class="font-semibold text-white">Navigation</p>

                <ul class="grid gap-2 leading-tight mt-4">
                    <li>
                        <a href="{{ route('home') }}">
                            Accueil
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('posts.index') }}">
                            Blog
                        </a>
                    </li>
                </ul>
            </nav>

            <div>
                <p class="font-semibold text-white">Réseaux sociaux</p>

                <ul class="grid gap-2 leading-tight mt-4">
                    <li>
                        <a href="https://twitter.com/Larabiz_">
                            @Larabiz_
                        </a>
                    </li>

                    <li>
                        <a href="https://twitter.com/Larabiz_">
                            @benjamincrozat
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <p class="mt-8 text-center text-gray-700 text-xs">© {{ date('Y') }} {{ config('app.name') }}</p>
    </footer>
</div>
