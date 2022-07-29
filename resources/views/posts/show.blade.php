<x-app
    :title="$post->title"
    :description="$post->excerpt"
    :image="$post->getFirstMediaUrl('illustration', 'large')"
>
    <div class="container py-8 sm:py-16">
        <nav>
            <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-1 font-semibold text-indigo-400">
                <x-heroicon-o-arrow-left class="-mt-[.0625rem] h-4" /> Retour au blog
            </a>
        </nav>

        <article class="pb-8 sm:pb-16 pt-6 sm:pt-14">
            <h1 class="font-thin text-3xl sm:text-5xl">
                @if ($post->is_draft) Brouillon : @endif {{ $post->title }}
            </h1>

            <div class="border-y border-indigo-100 flex items-center gap-4 mt-6 py-4 text-sm">
                <img loading="lazy" src="https://www.gravatar.com/avatar/{{ md5($post->user->email) }}?s=144" alt="Avatar de {{ $post->user->username }}." width="42" height="42" class="relative top-[-.0625rem] rounded-full">

                <div>
                    <p>Mis à jour le <time datetime="{{ $post->created_at->toDateString() }}" class="font-bold">{{ $post->created_at->isoFormat('ll') }}</time> par <span class="font-bold">{{ $post->user->username }}</span></p>

                    @if ($post->certified_for_laravel)
                        <p>Article certifié pour <strong class="font-bold">Laravel {{ $post->certified_for_laravel }}</strong></p>
                    @endif
                </div>
            </div>

            <div class="font-light mt-6 text-indigo-400 text-xl">
                {{ $post->excerpt }}
            </div>

            @if ($url = $post->getFirstMediaUrl('illustration', 'large'))
                <img loading="lazy" src="{{ $url }}" alt="" class="mt-8" />
            @endif

            <div class="bg-indigo-100 flex items-center gap-4 mt-8 p-4 rounded-lg text-indigo-900/75">
                <x-heroicon-o-information-circle class="flex-shrink-0 w-5 h-5" />

                <div>
                    <div>
                        Quelque chose vous échappe au sujet de cet article&nbsp;? <a href="#comments" class="font-semibold text-indigo-900" @click="window.fathom?.trackGoal('SNY6VO5I', 0)">Demandez de l'aide dans les commentaires</a>.
                    </div>

                    <div class="font-bold mt-2 text-indigo-700" x-show="document.getElementById('comments').clientHeight === 0">
                        Désactivez votre bloqueur de pub sur {{ config('app.name') }}, car il semble qu'il masque la section commentaires&nbsp;!
                    </div>
                </div>
            </div>

            <div class="break-words prose prose-a:bg-indigo-100 prose-a:font-bold prose-a:no-underline prose-a:text-indigo-400 prose-blockquote:border-l-[6px] prose-blockquote:border-indigo-200 prose-blockquote:font-serif prose-blockquote:text-indigo-900/75 prose-h3:leading-tight prose-img:my-0 prose-figure:mx-auto prose-figure:text-center prose-figure:sm:w-2/3 prose-figure:md:w-1/2 prose-strong:font-bold !max-w-none mt-8">
                {!! \Illuminate\Support\Str::marxdown($post->content) !!}
            </div>
        </article>

        <x-author
            :author="$post->user"
            class="border-y border-indigo-100 py-8"
        />

        <div
            id="comments"
            class="mt-8 sm:mt-16"
            x-intersect="window.fathom?.trackGoal('0DZGVNFZ', 0)"
        >
            <livewire:comments :post="$post" />
        </div>
    </div>

    <div class="bg-indigo-100">
        <x-newsletter class="container">
            <x-slot:title tag="h3">
                Passez à la pratique<br />
                <span class="text-indigo-400">Trouvez votre prochain emploi PHP+Laravel</span>
            </x-slot>
        </x-newsletter>
    </div>

    <x-section class="max-w-[1024px]" x-intersect="window.fathom?.trackGoal('XFZRYOKR', 0)">
        <x-slot:title tag="h3">
            Autres articles à lire
        </x-slot>

        <div class="grid md:grid-cols-2 gap-8 mt-8">
            @foreach ($others as $post)
                <x-post :post="$post" />
            @endforeach
        </div>
    </x-section>
</x-app>
