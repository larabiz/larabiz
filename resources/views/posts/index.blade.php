<x-layout.app title="Blog">
    <x-breadcrumb.container class="mt-16">
        <x-breadcrumb.item>Blog</x-breadcrumb.item>
    </x-breadcrumb.container>

    <x-layout.section class="container">
        <x-forms.form method="GET" :action="route('search-posts')" class="text-center">
            <label for="q" class="sr-only">Rechercher</label>

            <div class="bg-white md:max-w-[360px] mx-auto relative rounded table shadow shadow-indigo-100 w-full">
                <input
                    type="search"
                    id="q"
                    name="q"
                    value="{{ old('search') }}"
                    placeholder="routing, controller, etc."
                    required
                    class="bg-transparent border-0 placeholder-indigo-200/75 pl-12 pr-20 py-3 rounded w-full"
                    x-ref="searchField"
                    @keydown.cmd.k.window="$refs.searchField.focus()"
                    @keydown.ctrl.k.window="$refs.searchField.focus()"
                />

                <x-heroicon-o-search class="absolute top-1/2 left-4 text-indigo-200/75 w-4 h-4 -translate-y-1/2" />

                <div class="absolute top-1/2 right-2 border border-indigo-100 px-2 py-1 rounded-sm text-indigo-200/75 text-xs -translate-y-1/2">
                    Ctrl/⌘K
                </div>
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
                    "name": "Blog"
                }]
            }
        </script>
    @endpush
</x-layout.app>
