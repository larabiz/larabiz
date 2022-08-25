<x-layout.app :title='$q ? "Articles correspondant à « $q »" : "Recherche"'>
    <x-breadcrumb.container class="mt-16">
        <x-breadcrumb.item :link="route('posts.index')">Blog</x-breadcrumb.item>
        <x-breadcrumb.item>Recherche</x-breadcrumb.item>
        <x-breadcrumb.item>Articles correspondant à « {{ $q }} »</x-breadcrumb.item>
    </x-breadcrumb.container>

    <x-layout.section class="container">
        <x-slot:title>
            Articles correspondant à « {{ $q }} »
        </x-slot:title>

        <x-forms.form method="GET" :action="route('search-posts')" class="text-center">
            <label for="q" class="sr-only">Rechercher</label>

            <div class="bg-white md:max-w-[320px] mx-auto relative rounded table shadow shadow-indigo-100 w-full">
                <input type="search" id="q" name="q" value="{{ old('search') ?? $q }}" placeholder="routing, controller, etc." required class="bg-transparent border-0 pl-12 placeholder-indigo-200/75 pr-4 py-3 rounded w-full" />
                <x-heroicon-o-search class="absolute top-1/2 left-4 text-indigo-200/75 w-4 h-4 -translate-y-1/2" />
            </div>

            <button type="submit" class="sr-only">
                Rechercher
            </button>
        </x-forms.form>

        <div class="grid gap-8 mt-8">
            @forelse ($posts as $post)
                <x-posts.post :post="$post" />
            @empty
                <p class="md:col-span-2 text-center text-indigo-300">
                    Il n'y a aucun article correspondant à vos critères.
                </p>
            @endforelse
        </div>
    </x-layout.section>

    @push('scripts')
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
                    "name": "Recherche"
                }, {
                    "@type": "ListItem",
                    "position": 2,
                    "name": "{{ $q }}"
                }]
            }
        </script>
    @endpush
</x-layout.app>
