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
                    <p>Mis à jour le <time datetime="{{ $post->updated_at->toDateString() }}" class="font-bold">{{ $post->updated_at->isoFormat('ll') }}</time> par <span class="font-bold">{{ $post->user->username }}</span></p>

                    @if ($post->certified_for_laravel)
                        <p>Article certifié pour <strong>Laravel {{ $post->certified_for_laravel }}</strong></p>
                    @endif
                </div>
            </div>

            <div class="font-light mt-6 text-indigo-400 text-xl">
                {{ $post->excerpt }}
            </div>

            @if ($url = $post->getFirstMediaUrl('illustration', 'large'))
                <img loading="lazy" src="{{ $url }}" alt="" class="mt-8" />
            @endif

            <div class="break-words prose prose-a:bg-indigo-100 prose-a:font-bold prose-a:no-underline prose-a:text-indigo-400 prose-blockquote:border-l-[6px] prose-blockquote:border-indigo-200 prose-blockquote:font-serif prose-blockquote:text-indigo-900 prose-blockquote:text-opacity-75 prose-h3:leading-tight prose-img:my-0 prose-figure:mx-auto prose-figure:text-center prose-figure:sm:w-2/3 prose-figure:md:w-1/2 prose-strong:font-bold !max-w-none mt-8">
                {!! \Illuminate\Support\Str::marxdown($post->content) !!}
            </div>
        </article>

        <x-author :author="$post->user" class="border-t border-indigo-100 pt-8 sm:pt-16" />
    </div>

    <div class="bg-indigo-100">
        <x-newsletter class="container">
            <x-slot:title tag="h3">
                Passez à la pratique<br />
                <span class="text-indigo-400">Trouvez votre prochain emploi PHP+Laravel</span>
            </x-slot>
        </x-newsletter>
    </div>

    <x-section class="max-w-[1024px]">
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
