<x-app>
    <x-newsletter>
        <x-slot:title>
            Trouvez votre prochain emploi&nbsp;<span class="text-indigo-400">PHP</span>+<span class="text-indigo-400">Laravel</span>
        </x-slot>

        <div class="italic mt-8 sm:mt-16">
            <p>Salut, moi c'est <a href="{{ route('about') }}" class="bg-indigo-100 font-bold text-indigo-400">Benjamin</a>&nbsp;! 👋 Cela fait plus de 10 ans que je suis développeur web.</p>

            <p class="mt-4">Il y a quelques années, je découvrais Laravel et ce fut une révélation. À l'époque, il y avait peu d'offres d'emploi ouvertes à son utilisation. Je devais me contenter de projets WordPress et l'expérience était pour le moins… frustrante.</p>

            <p class="mt-4">Aujourd'hui, les choses ont changé. Le web pullule d'offres d'emploi en tout genre. <strong class="bg-purple-200 font-semibold">Je vous aide à faire le tri afin de trouver les opportunités qui vous permetteront de gagner de l'expérience avec Laravel</strong>.</p>
        </div>
    </x-newsletter>

    <div class="bg-indigo-100" x-intersect="window.fathom?.trackGoal('ECBYPDIG', 0)">
        <x-section class="max-w-[1024px]">
            <x-slot:title tag="h2" class="text-xl md:text-3xl">
                Augmentez vos chances d'être&nbsp;recruté<br />
                <span class="text-indigo-400">Développez vos compétences</span>
            </x-slot>

            <p class="text-center sm:text-lg md:text-xl">
                {{ config('app.name') }} est aussi une plateforme permettant d'apprendre PHP et Laravel. Découvrez des articles en français de qualité, remplis de conseils appliquables immédiatement.
            </p>

            <div class="grid md:grid-cols-2 gap-8 mt-16">
                @foreach ($latest as $post)
                    <x-post :post="$post" />
                @endforeach
            </div>

            <x-primary href="{{ route('posts.index') }}" class="mt-8 mx-auto table" @click="window.fathom?.trackGoal('QEMXBB9C', 0)">
                Et plus encore sur le blog
            </x-primary>
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
                    <x-cta
                        href="{{ route('posts.index') }}"
                        class="mt-4 text-center sm:text-left w-full sm:w-auto"
                        @click="window.fathom?.trackGoal('NECDT6XG', 0)"
                    >
                        Commencer
                    </x-cta>
                @else
                    <x-cta
                        href="{{ route('register') }}"
                        class="font-extrabold mt-4 px-4 md:px-8 text-center sm:text-left w-full sm:w-auto"
                        @click="window.fathom?.trackGoal('TBIFNVNC', 0)"
                    >
                        Inscrivez-vous <span class="font-light">pour commencer</span>
                    </x-cta>
                @endauth
            </div>

            <div class="sm:col-span-3 order-1 sm:order-none self-center text-center">
                <x-icon-comments class="h-[30vh] sm:h-auto inline" />
            </div>
        </div>
    </x-section>
</x-app>
