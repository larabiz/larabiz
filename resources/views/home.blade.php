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
                {{ config('app.name') }} est une plateforme permettant d'apprendre PHP et Laravel.<br />
                Découvrez des articles en français de qualité, remplis de tout plein de bonnes choses.
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

    <x-layout.section x-intersect="window.fathom?.trackGoal('0JCL9NAI', 0)">
        <x-slot:title tag="h2" class="text-xl md:text-3xl">
            Ne soyez pas timide<br />
            <span class="text-indigo-400">La communauté est là pour vous aider</span>
        </x-slot>

        <div class="grid sm:grid-cols-7 gap-8">
            <div class="sm:col-span-4 order-2 sm:order-none self-center md:text-lg">
                <div>
                    Quelque chose vous échappe au sujet d'un article&nbsp;? <strong class="font-bold">La section commentaires</strong> est là pour recevoir vos questions. Les contributeurs se feront un plaisir d'y répondre.
                </div>

                @auth
                    <x-buttons.cta
                        href="{{ route('posts.index') }}"
                        class="mt-4 text-center sm:text-left w-full sm:w-auto"
                        @click="window.fathom?.trackGoal('NECDT6XG', 0)"
                    >
                        Commencer
                    </x-buttons.cta>
                @else
                    <x-buttons.cta
                        href="{{ route('register') }}"
                        class="font-extrabold mt-4 px-4 md:px-8 text-center sm:text-left w-full sm:w-auto"
                        @click="window.fathom?.trackGoal('TBIFNVNC', 0)"
                    >
                        Inscrivez-vous <span class="font-light">pour commencer</span>
                    </x-buttons.cta>
                @endauth
            </div>

            <div class="sm:col-span-3 order-1 sm:order-none self-center text-center">
                <x-icon-comments class="h-[30vh] sm:h-auto inline" />
            </div>
        </div>
    </x-layout.section>

    <div class="bg-indigo-100" x-intersect="window.fathom?.trackGoal('SAOGYGTN', 0);">
        <x-layout.section id="about">
            <x-slot:title tag="h2" class="text-xl md:text-3xl">
                À propos de {{ config('app.name') }}
            </x-slot>

            <div>
                <figure class="float-right mb-8 ml-8 text-center">
                    <img loading="lazy" src="https://www.gravatar.com/avatar/{{ md5('benjamincrozat@me.com') }}?s=144" width="150" height="150" alt="Photo de Benjamin." class="inline rounded-full w-[100px] h-[100px] sm:w-[150px] sm:h-[150px]">
                </figure>

                <p>Prendre des conseils d'étrangers sur internet n'est pas vraiment une chose facile. Laissez-moi me présenter.</p>

                <p class="mt-4">Je m'appelle Benjamin Crozat (<a href="https://twitter.com/benjamincrozat" class="bg-purple-200/75 font-bold text-indigo-400">@benjamincrozat</a>). Développeur web depuis de nombreuses années, j'ai accumulé énormément d'expérience. Mais j'ai également commis des erreurs. <em>Beaucoup</em>.</p>

                <p class="mt-4">À travers {{ config('app.name') }}, j'ai envie de créer une communauté Laravel francophone dans le but d'aider les développeurs à accumuler autant d'expérience, tout en leur évitant de refaire les mêmes erreurs.<br />
                Étant autodidacte depuis mon adolescence, il est bien normal que je contribue à mon tour.</p>
            </p>
        </x-layout.section>
    </div>

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
