<x-layout.app
    title="Apprenez PHP et Laravel en français avec {{ config('app.name') }}"
    seo-title="Apprendre à développer en PHP et Laravel en ligne en français"
    description="Apprenez PHP et Laravel en français avec des articles de qualité et plus encore sur {{ config('app.name') }}, la meilleure communauté francophone PHP et Laravel."
>
    <x-newsletter>
        <x-slot:title>
            Apprenez PHP et Laravel <span class="text-indigo-400">en français</span>
        </x-slot:title>

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

        <ol class="font-thin grid gap-4 mt-8 sm:mt-16 text-xl">
            <li class="flex items-center gap-6">
                <span class="translate-y-[-0.5px] bg-indigo-400/50 flex items-center justify-center rounded-full text-white text-sm w-8 h-8">1</span>
                <span><a href="{{ route('register') }}" class="text-indigo-400 font-light">Créez votre compte utilisateur</a>. C'est rapide et gratuit.</span>
            </li>

            <li class="flex items-center gap-6">
                <span class="translate-y-[-0.5px] bg-indigo-400/75 flex items-center justify-center rounded-full text-white text-sm w-8 h-8">2</span>
                <span>Validez votre adresse e-mail, c'est comme ça qu'on lutte contre les bots.</span>
            </li>

            <li class="flex items-center gap-6">
                <span class="translate-y-[-0.5px] bg-indigo-400 flex items-center justify-center rounded-full text-white text-sm w-8 h-8">3</span>
                <span>Démarrez une nouvelle discussion sur le <a href="#" class="text-indigo-400 font-light">forum</a> ou le <a href="{{ route('posts.index') }}" class="text-indigo-400 font-light">blog</a>.</span>
            </li>
        </ol>
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
