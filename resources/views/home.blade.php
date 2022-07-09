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
        <x-section class="max-w-[1024px]">
            <x-slot:title tag="h2" class="text-xl md:text-3xl">
                Augmentez vos chances d'être&nbsp;recruté<br>
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

            <x-primary href="{{ route('posts.index') }}" class="mt-8 mx-auto table">
                Et plus encore sur le blog
            </x-primary>
        </x-section>
    </div>

    <x-section id="about">
        <x-slot:title tag="h2">
            Découvrez votre serviteur
        </x-slot>

        <div class="italic">
            <figure class="float-right mb-8 ml-8 text-center">
                <img loading="lazy" src="https://www.gravatar.com/avatar/{{ md5('hello@benjamincrozat.com') }}?s=144" width="150" height="150" alt="Photo de Benjamin." class="inline rounded-full w-[100px] h-[100px] sm:w-[150px] sm:h-[150px]">
            </figure>

            <p>Prendre des conseils d'étrangers sur internet n'est pas vraiment une chose facile. Laissez-moi me présenter.</p>

            <p class="mt-4">Je m'appelle Benjamin (<a href="https://twitter.com/benjamincrozat" class="bg-indigo-100 font-bold text-indigo-400">@benjamincrozat</a>). Développeur web depuis de nombreuses années, j'ai accumulé énormément d'expérience. Mais j'ai également commis des erreurs. <em>Beaucoup</em>.</p>

            <p class="mt-4">À travers {{ config('app.name') }}, j'ai envie d'aider les développeurs à accumuler autant d'expérience, tout en évitant de refaire les mêmes erreurs.<br>
            Étant autodidacte depuis mon adolescence, il est bien normal que je contribue à mon tour à la communauté.</p>
        </div>
    </x-section>
</x-app>
