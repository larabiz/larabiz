<x-layout.app
    title="{{ $post->title }}"
    description="{{ $post->excerpt }}"
    image="{{ $post->preview_url }}"
>
    <x-breadcrumb.container class="mt-16">
        <x-breadcrumb.item link="{{ route('posts.index') }}">Blog</x-breadcrumb.item>
        <x-breadcrumb.item>{{ $post->title }}</x-breadcrumb.item>
    </x-breadcrumb.container>

    <div class="container py-8 sm:py-16">
        <article class="pb-8 sm:pb-16">
            <h1 class="font-thin text-3xl sm:text-5xl">
                @if ('draft' === $post->status) Brouillon : @endif {{ $post->title }}
            </h1>

            <div class="border-y border-indigo-100 flex items-center gap-4 mt-6 py-4 text-sm">
                <img loading="lazy" src="https://www.gravatar.com/avatar/{{ md5($post->user->email) }}?s=144" alt="Avatar de {{ $post->user->username }}." width="42" height="42" class="relative top-[-.0625rem] rounded-full">

                <div>
                    <p>
                        @if ('draft' === $post->status) Brouillon créé le @else Publié le @endif
                        <time datetime="{{ $post->latestStatus()?->created_at->toDateString() }}" class="font-bold">
                            {{ $post->latestStatus()?->created_at->isoFormat('ll') }}
                        </time>
                        par <span class="font-bold">{{ $post->user->username }}</span>
                    </p>

                    <p>
                        Temps de lecture estimé :
                        <span class="font-bold">@choice(':count minute|:count minutes', $post->read_time)</span>
                    </p>
                </div>
            </div>

            <div class="font-light mt-6 text-indigo-400 text-xl">
                {{ $post->excerpt }}
            </div>

            <div class="bg-indigo-100 flex items-center gap-4 mt-8 p-4 rounded-lg text-indigo-900/75">
                <x-heroicon-o-information-circle class="flex-shrink-0 w-5 h-5" />

                <aside>
                    <div>
                        Quelque chose vous échappe au sujet de cet article&nbsp;? <a href="#comments" class="font-semibold text-indigo-900" @click="window.fathom?.trackGoal('SNY6VO5I', 0)">Demandez de l'aide dans les commentaires</a>.
                    </div>

                    <div class="font-bold mt-2 text-indigo-700" x-show="document.getElementById('comments').clientHeight === 0">
                        Désactivez votre bloqueur de pub sur {{ config('app.name') }}, car il semble qu'il masque la section commentaires&nbsp;!
                    </div>
                </aside>
            </div>

            <div class="break-words prose prose-a:bg-indigo-100 prose-a:font-bold prose-a:no-underline prose-a:text-indigo-400 prose-blockquote:border-l-[6px] prose-blockquote:border-indigo-200 prose-blockquote:font-serif prose-blockquote:text-indigo-900/75 prose-h3:leading-tight prose-img:my-0 prose-figure:mx-auto prose-figure:text-center prose-figure:sm:w-2/3 prose-figure:md:w-1/2 prose-strong:font-bold !max-w-none mt-8">
                {!! \Illuminate\Support\Str::marxdown($post->content) !!}
            </div>
        </article>

        <x-posts.author
            :author="$post->user"
            class="border-y border-indigo-100 py-8"
        />

        @push('scripts')
            <script type="application/ld+json">
                {
                    "@context": "https://schema.org",
                    "@type": "NewsArticle",
                    "headline": "{{ $post->title }}",
                    "datePublished": "{{ $post->latestStatus('published')?->created_at->toIso8601String() }}",
                    "dateModified": "{{ $post->updated_at->toIso8601String() }}",
                    "author": [
                        {
                            "@type": "Person",
                            "name": "{{ $post->user->username }}",
                            "url": "{{ route('home') }}"
                        }
                    ]
                }
            </script>

            <script type="application/ld+json">
                {
                    "@context": "https://schema.org",
                    "@type": "BreadcrumbList",
                    "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "name": "Blog",
                        "item": "{{ route('posts.index') }}"
                    }, {
                        "@type": "ListItem",
                        "position": 2,
                        "name": "{{ $post->title }}"
                    }]
                }
            </script>
        @endpush

        <div
            id="comments"
            class="mt-8 sm:mt-16 scroll-mt-8 sm:scroll-mt-16"
            x-intersect="window.fathom?.trackGoal('0DZGVNFZ', 0)"
        >
            <h2 class="font-extrabold leading-tight mb-8 sm:mb-16 text-center text-xl">
                @choice(':count commentaire|:count commentaires', $post->comments_count)
            </h2>

            <div class="grid gap-4">
                @foreach ($post->comments as $comment)
                    <x-comments.comment :comment="$comment" />
                @endforeach
            </div>

            @auth
                @if (! $user?->hasVerifiedEmail())
                    <div class="mt-8 sm:mt-16 text-center text-indigo-900/75 text-lg sm:text-xl">
                        Vous y êtes presque.<br />
                        Il n'y a plus qu'à confirmer votre adresse e-mail.
                    </div>
                @elseif ($user?->hasVerifiedEmail())
                    <x-comments.form :post="$post" :subscribed="$subscribed" />
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
            <x-slot:headline tag="h2">
                Ça vous a plu ?<br />
                <span class="text-indigo-400">Abonnez-vous à la newsletter !</span>
            </x-slot:headline>

            <x-slot:subheadline>
                Recevez régulièrement news, trucs et astuces à propos de Laravel et son ecosystème.
            </x-slot:subheadline>
        </x-newsletter>
    </div>

    <x-layout.section x-intersect="window.fathom?.trackGoal('XFZRYOKR', 0)">
        <x-slot:title tag="h3">
            Autres articles à lire
        </x-slot>

        <div class="grid gap-8 mt-8">
            @foreach ($others as $post)
                <x-posts.post :post="$post" />
            @endforeach
        </div>
    </x-layout.section>
</x-layout.app>
