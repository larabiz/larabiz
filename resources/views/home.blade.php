<x-app
    title="Apprenez PHP et Laravel en français avec {{ config('app.name') }}"
    description="Retrouvez les dernières offres d'emploi, des articles de qualité et plus encore avec Larabiz, la meilleure communauté francophone PHP et Laravel."
>
    <x-newsletter>
        <x-slot:title>
            Apprenez PHP et Laravel <strong class="text-indigo-400">en français</strong>
        </x-slot:title>

        <div class="italic mt-8 sm:mt-16">
            <p>Salut, moi c'est Benjamin&nbsp;! 👋 Cela fait plus de 10 ans que je suis développeur web.</p>

            <p class="mt-4">Il y a quelques années, je découvrais Laravel et ce fut une révélation. À l'époque, il y avait peu d'offres d'emploi ouvertes à son utilisation. Mais les choses ont changé.</p>

            <p class="mt-4">Aujourd'hui, <strong class="bg-purple-200/75 dark:bg-purple-400/20 font-semibold">Laravel est un excellent investissement</strong> et j'ai créé Larabiz afin d'aider autant de gens que possible à voir leur vie changée grâce à cet ecosystème.</p>
        </div>
    </x-newsletter>

    <div class="bg-indigo-100 dark:bg-gray-800" x-intersect="window.fathom?.trackGoal('ECBYPDIG', 0)">
        <x-section class="max-w-[1024px]">
            <x-slot:title tag="h2" class="text-xl md:text-3xl">
                Augmentez vos chances d'être&nbsp;recruté<br />
                <span class="text-indigo-400">Développez vos compétences</span>
            </x-slot>

            <p class="text-center sm:text-lg md:text-xl">
                {{ config('app.name') }} est aussi une plateforme permettant d'apprendre PHP et Laravel. Découvrez des articles en français de qualité, remplis de conseils appliquables immédiatement.
            </p>

            <ul class="grid md:grid-cols-2 gap-8 mt-16">
                @foreach ($latest as $post)
                    <li><x-posts.post :post="$post" /></li>
                @endforeach
            </ul>

            <x-buttons.primary href="{{ route('posts.index') }}" class="mt-8 mx-auto table" @click="window.fathom?.trackGoal('QEMXBB9C', 0)">
                Et plus encore sur le blog
            </x-buttons.primary>
        </x-section>
    </div>

    <x-section class="md:max-w-screen-md" x-intersect="window.fathom?.trackGoal('0JCL9NAI', 0)">
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
    </x-section>

    <div class="bg-indigo-100 dark:bg-gray-800" x-intersect="window.fathom?.trackGoal('SAOGYGTN', 0);">
        <x-section id="about" class="md:max-w-screen-md">
            <x-slot:title tag="h2" class="text-xl md:text-3xl">
                À propos de {{ config('app.name') }}
            </x-slot>

            <div>
                <figure class="float-right mb-8 ml-8 text-center">
                    <img loading="lazy" src="https://www.gravatar.com/avatar/{{ md5('benjamincrozat@me.com') }}?s=144" width="150" height="150" alt="Photo de Benjamin." class="inline rounded-full w-[100px] h-[100px] sm:w-[150px] sm:h-[150px]">
                </figure>

                <p>Prendre des conseils d'étrangers sur internet n'est pas vraiment une chose facile. Laissez-moi me présenter.</p>

                <p class="mt-4">Je m'appelle Benjamin (<a href="https://twitter.com/benjamincrozat" class="bg-indigo-100 font-bold text-indigo-400">@benjamincrozat</a>). Développeur web depuis de nombreuses années, j'ai accumulé énormément d'expérience. Mais j'ai également commis des erreurs. <em>Beaucoup</em>.</p>

                <p class="mt-4">À travers {{ config('app.name') }}, j'ai envie de créer une communauté Laravel francophone dans le but d'aider les développeurs à accumuler autant d'expérience, tout en leur évitant de refaire les mêmes erreurs.<br />
                Étant autodidacte depuis mon adolescence, il est bien normal que je contribue à mon tour.</p>
            </p>
        </x-section>
    </div>
</x-app>
