<x-layout.app
    title="Apprenez PHP et Laravel en français avec {{ config('app.name') }}"
    description="Apprenez PHP et Laravel en français avec des articles de qualité et plus encore sur {{ config('app.name') }}, la meilleure communauté francophone PHP et Laravel."
>
    <x-newsletter>
        <x-slot:headline>
            Apprenez PHP et Laravel <span class="text-indigo-400">en français</span>
        </x-slot:headline>

        <x-slot:subheadline>
            Abonnez-vous à la newsletter et recevez régulièrement news, trucs et astuces à propos de Laravel et son ecosystème.
        </x-slot:subheadline>

        <div class="italic mt-8 sm:mt-16">
            <p>Salut, moi c'est Benjamin&nbsp;! 👋 Cela fait plus de 10 ans que je suis développeur web.</p>

            <p class="mt-4">Il y a quelques années, je découvrais Laravel et ce fut une révélation. À l'époque, il y avait peu d'offres d'emploi ouvertes à son utilisation. Mais les choses ont changé.</p>

            <p class="mt-4">Aujourd'hui, <strong class="bg-purple-200/75 font-semibold">Laravel est un excellent investissement</strong>. J'ai créé Larabiz afin d'aider les développeurs à apprendre à coder en PHP et Laravel en ligne et en français.</p>
        </div>
    </x-newsletter>

    <div class="bg-indigo-100" x-intersect="window.fathom?.trackGoal('ECBYPDIG', 0)">
        <x-layout.section>
            <x-slot:title tag="h2" class="text-xl md:text-3xl">
                Augmentez vos chances d'être&nbsp;recruté<br />
                <span class="text-indigo-400">Développez vos compétences</span>
            </x-slot>

            <p class="text-center sm:text-lg">
                Avec {{ config('app.name') }} apprenez PHP et Laravel en ligne et en français.<br class="hidden md:inline" />
                Découvrez des articles de qualité, remplis de tout plein de bonnes choses.
            </p>

            <div class="grid gap-8 mt-16">
                @foreach ($latest as $post)
                    <x-posts.post :post="$post" />
                @endforeach
            </div>

            <x-buttons.primary href="{{ route('posts.index') }}" class="mt-16 mx-auto table" @click="window.fathom?.trackGoal('QEMXBB9C', 0)">
                La suite sur le blog
            </x-buttons.primary>
        </x-layout.section>
    </div>

    <x-layout.section class="lg:max-w-[1024px]" x-intersect="window.fathom?.trackGoal('0JCL9NAI', 0)">
        <x-slot:title tag="h2" class="text-xl md:text-3xl">
            Ne soyez pas timide<br />
            <span class="text-indigo-400">La communauté est là pour vous aider</span>
        </x-slot>

        <div class="text-center">
            <x-icon-comments class="inline" />
        </div>

        <ol class="font-thin grid gap-4 mt-8 sm:mt-16 sm:text-lg md:text-xl">
            <li class="flex items-center gap-4 sm:gap-6">
                <span class="translate-y-[-0.5px] bg-indigo-400/50 flex flex-shrink-0 items-center justify-center rounded-full text-white text-xs sm:text-sm w-6 sm:w-8 h-6 sm:h-8">
                    <span class="translate-y-[0.5px]">1</span>
                </span>

                <span><a href="{{ route('register') }}" class="text-indigo-400 font-light">Créez votre compte utilisateur</a>. C'est rapide et gratuit.</span>
            </li>

            <li class="flex items-center gap-4 sm:gap-6">
                <span class="translate-y-[-0.5px] bg-indigo-400/75 flex flex-shrink-0 items-center justify-center rounded-full text-white text-xs sm:text-sm w-6 sm:w-8 h-6 sm:h-8">
                    <span class="translate-y-[0.5px]">2</span>
                </span>

                <span>Validez votre adresse e-mail, c'est comme ça qu'on lutte contre les bots.</span>
            </li>

            <li class="flex items-center gap-4 sm:gap-6">
                <span class="translate-y-[-0.5px] bg-indigo-400 flex flex-shrink-0 items-center justify-center rounded-full text-white text-xs sm:text-sm w-6 sm:w-8 h-6 sm:h-8">
                    <span class="translate-y-[0.5px]">3</span>
                </span>

                <span>Démarrez une nouvelle discussion sur le <a href="#" class="text-indigo-400 font-light" @click.prevent="alert('Il n\'y a rien à voir pour le moment. Mais les commentaires sur le blog sont opérationnels et n\'attendent que vous !')">forum</a> ou le <a href="{{ route('posts.index') }}" class="text-indigo-400 font-light">blog</a>.</span>
            </li>
        </ol>
    </x-layout.section>

    <div class="bg-gradient-to-t from-indigo-200/50 to-indigo-100" x-intersect="window.fathom?.trackGoal('', 0)">
        <div class="-mb-2 sm:-mb-10 pt-8 sm:pt-16 px-4 text-center">
            <x-icon-lives class="max-h-[350px] inline" />
        </div>

        <x-layout.section>
            <x-slot:title tag="h2" class="text-xl md:text-3xl">
                <span class="text-indigo-400">Larabiz fait des lives</span> sur Twitter
            </x-slot>

            <p class="text-center sm:text-xl">
                <strong class="font-bold">Rompez la solitude du développeur</strong> en venant régulièrement participer aux lives !
            </p>

            <div class="mt-10 text-center">
                <x-buttons.cta href="https://twitter.com/i/events/1563989004944547846" target="_blank" rel="nofollow noopener noreferrer" class="inline-flex items-center gap-2">
                    <x-heroicon-o-play class="-ml-2 h-6 translate-y-[-.5px]" />
                    Écouter les précédents lives
                </x-buttons.cta>
            </div>
        </x-layout.section>
    </div>

    <x-layout.section class="max-w-[1024px]" x-intersect="window.fathom?.trackGoal('TNPEQ1XY', 0)">
        <x-slot:title tag="h2" class="text-xl md:text-3xl">
            {{ config('app.name') }} en quelques chiffres
        </x-slot>

        <p class="mt-8 text-center sm:text-xl">
            Afin que ce projet devienne un succès, les chiffres <strong class="font-bold">doivent</strong> atteindre des sommets.
        </p>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-8">
            <div class="bg-indigo-200/20 font-thin p-4 sm:px-4 sm:py-8 rounded text-center sm:text-lg md:text-xl">
                <x-heroicon-o-globe-alt class="inline w-12 h-12 text-indigo-700/50" />
                <span class="block mt-4 text-3xl md:text-5xl text-indigo-400">{{ $visits }}</span>
                <span class="block font-semibold text-indigo-900/75">visiteurs</span>
                <span class="block font-light mt-4 text-indigo-900/50 text-xs">sur les 30 derniers jours</span>
            </div>

            <div class="bg-indigo-200/20 font-thin p-4 sm:px-4 sm:py-8 rounded text-center sm:text-lg md:text-xl">
                <x-heroicon-o-eye class="inline w-12 h-12 text-indigo-700/50" />
                <span class="block mt-4 text-3xl md:text-5xl text-indigo-400">{{ $pageviews }}</span>
                <span class="block font-semibold text-indigo-900/75">pageviews</span>
                <span class="block font-light mt-4 text-indigo-900/50 text-xs">sur les 30 derniers jours</span>
            </div>

            <div class="bg-indigo-200/20 font-thin p-4 sm:px-4 sm:py-8 rounded text-center sm:text-lg md:text-xl">
                <x-heroicon-o-user-group class="inline w-12 h-12 text-indigo-700/50" />
                <span class="block mt-4 text-3xl md:text-5xl text-indigo-400">{{ $users_count }}</span>
                <span class="block font-semibold text-indigo-900/75">inscrits</span>
                <span class="block font-light mt-4 text-indigo-900/50 text-xs">ayant passé le filtre&nbsp;anti-bots</span>
            </div>

            <div class="bg-indigo-200/20 font-thin p-4 sm:px-4 sm:py-8 rounded text-center sm:text-lg md:text-xl">
                <x-heroicon-o-envelope class="inline w-12 h-12 text-indigo-700/50" />
                <span class="block mt-4 text-3xl md:text-5xl text-indigo-400">{{ $subscribers_count }}</span>
                <span class="block font-semibold text-indigo-900/75 truncate">abonnés à la newsletter</span>
                <span class="block font-light mt-4 text-indigo-900/50 text-xs">ayant passé le filtre&nbsp;anti-bots</span>
            </div>

            <div class="bg-indigo-200/20 font-thin p-4 sm:px-4 sm:py-8 rounded text-center sm:text-lg md:text-xl">
                <x-heroicon-o-newspaper class="inline w-12 h-12 text-indigo-700/50" />
                <span class="block mt-4 text-3xl md:text-5xl text-indigo-400">{{ $posts_count }}</span>
                <span class="block font-semibold text-indigo-900/75">articles</span>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="https://larabiz.fr/blog/BKMN8C/quel-avenir-pour-larabiz" class="border border-indigo-100 inline-flex items-center justify-center gap-2 font-semibold px-4 py-3 rounded text-indigo-400 text-sm sm:text-base">
                <x-heroicon-o-information-circle class="h-4 translate-y-[-0.5px]" />
                Découvrez comment et pourquoi contribuer.
            </a>
        </div>
    </x-layout.section>

    @push('scripts')
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "WebSite",
                "url": "{{ route('home') }}",
                "potentialAction": {
                    "@type": "SearchAction",
                    "target": {
                        "@type": "EntryPoint",
                        "urlTemplate": "{{ url('/blog/search?q={search_term}') }}"
                    },
                    "query-input": "required name=search_term"
                }
            }
        </script>
    @endpush
</x-layout.app>
