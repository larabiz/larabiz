<x-app
    title="Blog — Boostez votre carrière en apprenant Laravel"
    description="Découvrez le framework Laravel et l'écosystème de technologies gravitant autour."
>
    <x-section class="container max-w-[1024px]">
        <x-slot:title class="font-bold text-2xl">
            Blog
        </x-slot:title>

        {{-- Important text for SEO purposes. --}}
        <p class="sm:max-w-screen-sm sm:mx-auto mt-8 text-center">
            <strong class="font-semibold leading-tight text-xl">Boostez votre carrière de développeur&nbsp;web&nbsp;!</strong><br />
            <span class="inline-block mt-2 text-indigo-900/75">Découvrez le framework Laravel et l'écosystème de technologies gravitant autour grâce à toute une série d'articles et de tutoriels.</span>
        </p>

        <div class="grid md:grid-cols-2 gap-8 mt-8 sm:mt-16">
            @foreach ($posts as $post)
                <x-posts.post :post="$post" />
            @endforeach
        </div>
    </x-section>
</x-app>
