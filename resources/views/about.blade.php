<x-app
    title="Pourquoi Larabiz a été créé"
    description="Apprenez-en plus sur les motivations de la personne derrière Larabiz"
>
    <x-section>
        <x-slot:title>
            Pourquoi Larabiz a été créé
        </x-slot:title>

        <figure class="float-right mb-8 ml-8 text-center">
            <img loading="lazy" src="https://www.gravatar.com/avatar/{{ md5('benjamincrozat@me.com') }}?s=144" width="150" height="150" alt="Photo de Benjamin." class="inline rounded-full w-[100px] h-[100px] sm:w-[150px] sm:h-[150px]">
        </figure>

        <p>Prendre des conseils d'étrangers sur internet n'est pas vraiment une chose facile. Laissez-moi me présenter.</p>

        <p class="mt-4">Je m'appelle Benjamin (<a href="https://twitter.com/benjamincrozat" class="bg-indigo-100 font-bold text-indigo-400">@benjamincrozat</a>). Développeur web depuis de nombreuses années, j'ai accumulé énormément d'expérience. Mais j'ai également commis des erreurs. <em>Beaucoup</em>.</p>

        <p class="mt-4">À travers {{ config('app.name') }}, j'ai envie de créer une communauté Laravel francophone dans le but d'aider les développeurs à accumuler autant d'expérience, tout en leur évitant de refaire les mêmes erreurs.<br />
        Étant autodidacte depuis mon adolescence, il est bien normal que je contribue à mon tour.</p>
    </x-section>
</x-app>
