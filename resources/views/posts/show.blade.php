<x-app
    :title="$post->title"
    :description="$post->excerpt"
    :image="$post->preview_url"
>
    <x-breadcrumb class="container mt-8 sm:mt-16">
        <x-breadcrumb-item link="{{ route('posts.index') }}">Blog</x-breadcrumb-item>
        <x-breadcrumb-item>{{ $post->title }}</x-breadcrumb-item>
    </x-breadcrumb>

    <div class="container">
        <article class="py-8 sm:py-16">
            <h1 class="font-thin text-3xl sm:text-5xl">
                @if (! $post->status || 'draft' === $post->status) Brouillon : @endif {{ $post->title }}
            </h1>

            <div class="border-y border-indigo-100 flex items-center gap-4 mt-6 py-4 text-sm">
                <img loading="lazy" src="https://www.gravatar.com/avatar/{{ md5($post->user_email) }}?s=144" alt="Avatar de {{ $post->username }}." width="42" height="42" class="relative top-[-.0625rem] rounded-full">

                <div>
                    <p>
                        @if (! $post->status || 'draft' === $post->status) Brouillon créé le @else Publié le @endif
                        <time datetime="{{ $post->status()->created_at->toDateString() }}" class="font-bold">
                            {{ $post->status()->created_at->isoFormat('ll') }}
                        </time>
                        par <span class="font-bold">{{ $post->username }}</span>
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
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" /></svg>

                <aside>
                    <div>
                        Quelque chose vous échappe au sujet de cet article&nbsp;? <a href="#comments" class="font-semibold text-indigo-900" @click="window.fathom?.trackGoal('SNY6VO5I', 0)">Demandez de l'aide dans les commentaires</a>.
                    </div>

                    <div class="font-bold mt-2 text-indigo-700" x-show="document.getElementById('comments').clientHeight === 0">
                        Désactivez votre bloqueur de pub sur {{ config('app.name') }}, car il semble qu'il masque la section commentaires&nbsp;!
                    </div>
                </aside>
            </div>

            <x-table-of-contents :post="$post" />

            <div class="break-words prose prose-a:bg-indigo-100 prose-a:font-bold prose-a:no-underline prose-a:text-indigo-400 prose-blockquote:border-l-[6px] prose-blockquote:border-indigo-200 prose-blockquote:font-serif prose-blockquote:text-indigo-900/75 prose-h3:leading-tight prose-img:my-0 prose-figure:mx-auto prose-figure:text-center prose-figure:sm:w-2/3 prose-figure:md:w-1/2 prose-strong:font-bold !max-w-none mt-8">
                {!! \Illuminate\Support\Str::marxdown($post->content) !!}
            </div>
        </article>

        <x-author
            :username="$post->username"
            :email="$post->user_email"
            :biography="$post->user_biography"
            class="border-y border-indigo-100 py-8"
        />
    </div>

    @push('scripts')
        @if ($post->status === 'published')
            <script type="application/ld+json">
                {
                    "@context": "https://schema.org",
                    "@type": "NewsArticle",
                    "headline": "{{ $post->title }}",
                    "datePublished": "{{ $post->status()->created_at->toIso8601String() }}",
                    "dateModified": "{{ $post->updated_at->toIso8601String() }}",
                    "author": [
                        {
                            "@type": "Person",
                            "name": "{{ $post->username }}",
                            "url": "{{ route('home') }}"
                        }
                    ]
                }
            </script>
        @endif

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

    <div class="container py-8 sm:py-16">
        <div
            id="comments"
            class="scroll-mt-8 sm:scroll-mt-16"
            x-intersect="window.fathom?.trackGoal('0DZGVNFZ', 0)"
        >
            <h2 class="font-extrabold leading-tight mb-8 sm:mb-16 text-center text-xl">
                @choice(':count commentaire|:count commentaires', $post->comments_count)
            </h2>

            @if ($comments->isNotEmpty())
                <div class="grid gap-4">
                    @foreach ($comments as $comment)
                        <x-comment :comment="$comment" />
                    @endforeach
                </div>

                {{ $comments->fragment('comments')->links() }}
            @endif

            @auth
                @if (! $user?->hasVerifiedEmail())
                    <div class="mt-8 sm:mt-16 text-center text-indigo-900/75 text-lg sm:text-xl">
                        Vous y êtes presque.<br />
                        Il n'y a plus qu'à confirmer votre adresse e-mail.
                    </div>
                @elseif ($user?->hasVerifiedEmail())
                    <x-comments-form :post="$post" :subscribed="$subscribed" />
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

    <x-section x-intersect="window.fathom?.trackGoal('XFZRYOKR', 0)">
        <x-slot:title tag="h3">
            Autres articles à lire
        </x-slot>

        <div class="grid gap-8 mt-8">
            @foreach ($others as $post)
                <x-post :post="$post" />
            @endforeach
        </div>
    </x-section>
</x-app>
