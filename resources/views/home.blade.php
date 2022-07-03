<x-app>
    <x-newsletter>
        <x-slot:title>
            Trouvez votre prochain emploi&nbsp;<span class="text-indigo-400">PHP</span>+<span class="text-indigo-400">Laravel</span>
        </x-slot>

        <div class="italic mt-8 sm:mt-16">
            <p><strong>Salut, moi c'est <a href="{{ route('home') }}#about" class="bg-indigo-100 font-bold text-indigo-400">Benjamin</a> ! 👋</strong> Cela fait plus de 10 ans que je suis développeur web.</p>

            <p class="mt-4">Il y a quelques années, je découvrais Laravel et ce fut une révélation. À l'époque, il y avait peu d'offres d'emploi ouvertes à son utilisation. Je devais me contenter de projets WordPress et l'expérience était pour le moins… frustrante.</p>

            <p class="mt-4">Aujourd'hui, les choses ont changé. Le web pullule d'offres d'emploi en tout genre. <strong class="bg-purple-200">Je vous aide à faire le tri afin de trouver les opportunités qui vous permetteront de gagner de l'expérience avec Laravel</strong>.</p>
        </div>
    </x-newsletter>

    <div class="bg-indigo-100">
        <x-section>
            <x-slot:title tag="h2" class="text-xl md:text-3xl">
                Parcourez les dernières offres d'emploi<br>
                <span class="text-indigo-400">Postulez sans attendre !</span>
            </x-slot>

            <div class="grid gap-8 mt-14">
                @foreach (range(1, 6) as $i)
                    <div class="bg-white p-6 rounded-lg shadow-lg shadow-indigo-200/50">
                        <div>
                            <a href="#" class="font-bold !leading-tight text-indigo-400 text-xl">
                                {{ fake()->sentence() }}
                            </a>

                            <div class="text-gray-400">{{  fake()->company() }}</div>
                        </div>

                        <div class="mt-4">{{ fake()->paragraph() }}</div>

                        <div class="flex flex-wrap items-center justify-between mt-6">
                            <div class="flex flex-wrap justify-between gap-2 sm:gap-8 w-full">
                                <div class="flex items-center gap-2 text-indigo-300 w-full sm:w-auto">
                                    <x-heroicon-o-currency-euro class="w-5 h-5 translate-y-[-1px]" /> <span><span class="font-bold text-gray-700">25K€</span>-<span class="font-bold text-gray-700">35K€</span></span>
                                </div>

                                <div class="flex items-center gap-2 text-indigo-300 w-full sm:w-auto">
                                    <x-heroicon-o-home class="w-5 h-5 translate-y-[-1px]" /> <span class="font-bold text-gray-700">Remote</span>
                                </div>

                                <div class="flex items-center gap-2 text-indigo-300 w-full sm:w-auto">
                                    <x-heroicon-o-location-marker class="w-5 h-5 translate-y-[-1px]" /> <span class="font-bold text-gray-700">Paris, France</span>
                                </div>
                            </div>

                            <a href="#" class="bg-indigo-400 hover:bg-indigo-300 block font-bold mt-6 sm:mt-0 px-6 py-2 rounded-md text-center text-white transition-colors w-full sm:w-auto">
                                Postuler
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <x-cta href="#" class="mt-8 mx-auto table">
                Voir toutes les offres
            </x-cta>
        </x-layout>
    </div>

    <x-section class="max-w-[1024px]">
        <x-slot:title tag="h2" class="text-xl md:text-3xl">
            Augmentez vos chances d'être&nbsp;recruté<br>
            <span class="text-indigo-400">Développez vos compétences</span>
        </x-slot>

        <p class="text-center sm:text-lg md:text-xl">
            {{ config('app.name') }} est aussi une plateforme permettant d'apprendre PHP et Laravel. Découvrez des articles en français de qualité, remplis de conseils appliquables immédiatement.
        </p>

        <div class="grid gap-16 mt-16">
            <div>
                <h2 class="font-bold text-2xl">Derniers articles</h2>

                <div class="grid md:grid-cols-2 gap-8 mt-8">
                    @foreach (range(1, 4) as $i)
                        <x-post />
                    @endforeach
                </div>
            </div>

            <div>
                <h2 class="font-bold text-2xl">Articles les plus populaires</h2>

                <div class="grid md:grid-cols-2 gap-8 mt-8">
                    @foreach (range(1, 4) as $i)
                        <x-post />
                    @endforeach
                </div>
            </div>
        </div>

        <x-cta href="{{ route('posts.index') }}" class="mt-8 sm:mt-16 mx-auto table">
            Et plus encore sur le blog
        </x-cta>
    </x-section>

    <div class="bg-indigo-100">
        <x-section id="about">
            <x-slot:title tag="h2">
                Découvrez votre serviteur
            </x-slot>

            <div class="italic">
                <figure class="float-right mb-8 ml-8 text-center">
                    <img loading="lazy" src="https://www.gravatar.com/avatar/{{ md5('hello@benjamincrozat.com') }}?s=144" width="150" height="150" alt="Photo de Benjamin." class="inline rounded-full w-[100px] h-[100px] sm:w-[150px] sm:h-[150px]">
                </figure>

                <p>Prendre des conseils d'étrangers sur internet n'est pas vraiment une chose facile. Laissez-moi me présenter.</p>

                <p class="mt-4">Je m'appelle Benjamin (<a href="https://twitter.com/benjamincrozat" class="bg-indigo-100 font-bold text-indigo-400">@benjamincrozat</a>). Étant développeur web depuis de nombreuses années, j'ai accumulé énormément d'expérience. Mais j'ai également commis des erreurs. <em>Beaucoup</em>.</p>

                <p class="mt-4">À travers {{ config('app.name') }}, j'ai envie d'aider les développeurs à accumuler autant d'expérience, tout en évitant de refaire les mêmes erreurs.<br>
                Étant autodidacte depuis mon adolescence, il est bien normal que je contribue à mon tour à la communauté.</p>
            </div>
        </x-section>
    </div>
</x-app>
