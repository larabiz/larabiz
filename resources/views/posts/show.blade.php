<x-layout.app
    :title="$post->seo_title ?? $post->title"
    :description="$post->seo_excerpt ?? $post->excerpt"
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
                @if ('draft' === $post->status) Brouillon : @endif {{ $post->title }}
            </h1>

            <div class="border-y border-indigo-100 flex items-center gap-4 mt-6 py-4 text-sm">
                <img loading="lazy" src="https://www.gravatar.com/avatar/{{ md5($post->user->email) }}?s=144" alt="Avatar de {{ $post->user->username }}." width="42" height="42" class="relative top-[-.0625rem] rounded-full">

                <p>
                    @if ('draft' === $post->status) Brouillon créé le @else Publié le @endif
                    <time datetime="{{ $post->latestStatus()->created_at->toDateString() }}" class="font-bold">
                        {{ $post->latestStatus()->created_at->isoFormat('ll') }}
                    </time>
                    par <span class="font-bold">{{ $post->user->username }}</span>
                </p>
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

        <x-posts.author
            :author="$post->user"
            class="border-y border-indigo-100 py-8"
        />

        <div
            id="comments"
            class="mt-8 sm:mt-16 scroll-mt-8 sm:scroll-mt-16"
            x-intersect="window.fathom?.trackGoal('0DZGVNFZ', 0)"
        >
            <livewire:comments.listing :post="$post" />

            @auth
                @if (! $user?->hasVerifiedEmail())
                    <div class="mt-8 sm:mt-16 text-center text-indigo-900/75 text-lg sm:text-xl">
                        Vous y êtes presque.<br />
                        Il n'y a plus qu'à confirmer votre adresse e-mail.
                    </div>
                @elseif ($user?->hasVerifiedEmail())
                    <livewire:comments.form :post="$post" />
                @endif
            @else
                <div class="mt-8 sm:mt-16 text-center text-indigo-900/75 text-lg sm:text-xl">
                    Besoin d'aide&nbsp;? Envie de partager&nbsp;?<br />
                    <a href="{{ route('register') }}" class="font-semibold text-indigo-400">Inscrivez-vous</a> ou <a href="{{ route('login') }}" class="font-semibold text-indigo-400">connectez-vous</a> d'abord.
                </div>
            @endauth
        </div>
    </div>

    <div class="bg-indigo-100">
        <x-newsletter class="container">
            <x-slot:title tag="h2">
                Aimez-vous ce que vous avez lu ?<br />
                <span class="text-indigo-400">Abonnez-vous à la newsletter</span>
            </x-slot>
        </x-newsletter>
    </div>

    <x-section class="max-w-[1024px]" x-intersect="window.fathom?.trackGoal('XFZRYOKR', 0)">
        <x-slot:title tag="h3">
            Autres articles à lire
        </x-slot>

        <ul class="grid md:grid-cols-2 gap-8 mt-8">
            @foreach ($others as $post)
                <li><x-posts.post :post="$post" /></li>
            @endforeach
        </ul>
    </x-section>
</x-app>
