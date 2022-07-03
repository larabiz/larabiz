<x-app>
    <div class="container">
        <nav class="mt-8 sm:mt-16">
            <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-1 font-semibold text-indigo-400">
                <x-heroicon-o-arrow-left class="-mt-[.0625rem] h-4" /> Retour au blog
            </a>
        </nav>

        <article class="py-8 sm:py-16">
            <h1 class="font-thin text-3xl sm:text-5xl">
                {{ fake()->sentence() }}
            </h1>

            <div class="border-y border-indigo-100 flex items-center gap-4 mt-6 py-4 text-sm">
                <img loading="lazy" src="https://www.gravatar.com/avatar/{{ md5(fake()->safeEmail()) }}?s=144" alt="Avatar de {{ fake()->name() }}." width="42" height="42" class="relative top-[-.0625rem] rounded-full">

                <div>
                    <p>Mis à jour le <time datetime="{{ now()->subDays(mt_rand(1, 10))->toDateString() }}" class="font-bold">{{ now()->subDays(mt_rand(1, 10))->isoFormat('ll') }}</time> par <span class="font-bold">{{ fake()->name() }}</span></p>

                    <p>Article certifié pour <strong>Laravel 9</strong></p>
                </div>
            </div>

            <p class="font-light mt-6 text-indigo-400 text-xl">
                {{ fake()->paragraph() }}
            </p>

            <div class="aspect-video bg-black mt-8"></div>

            <div class="break-words prose prose-a:bg-indigo-100 prose-a:font-bold prose-a:no-underline prose-a:text-indigo-400 prose-blockquote:border-l-[6px] prose-blockquote:border-indigo-200 prose-blockquote:text-indigo-900 prose-blockquote:text-opacity-75 prose-h3:leading-tight prose-img:my-0 prose-figure:mx-auto prose-figure:text-center prose-figure:sm:w-2/3 prose-figure:md:w-1/2 !max-w-none mt-8">
                {{ fake()->paragraphs(5, true) }}
            </div>
        </article>

        <x-author />
    </div>

    <x-tilt from="fill-indigo-50" to="bg-indigo-100" />

    <div class="bg-indigo-100">
        <x-newsletter class="container py-8">
            <x-slot:title tag="h3">
                Passez à la pratique<br />
                <span class="text-indigo-400">Trouvez votre prochain emploi&nbsp;PHP+Laravel</span>
            </x-slot>
        </x-newsletter>
    </div>

    <x-tilt from="fill-indigo-100" to="bg-indigo-50" class="-scale-x-100" />

    <x-section class="max-w-[1024px]">
        <x-slot:title tag="h3">
            Autres articles à lire
        </x-slot>

        <div class="grid md:grid-cols-2 gap-8 mt-8">
            @foreach (range(1, 6) as $i)
                <x-post />
            @endforeach
        </div>
    </x-section>
</x-app>
