<x-app :title='$q ? "Articles correspondant à « $q »" : "Recherche"'>
    <x-breadcrumb class="mt-16">
        <x-breadcrumb-item :link="route('posts.index')">Blog</x-breadcrumb-item>
        <x-breadcrumb-item>Recherche</x-breadcrumb-item>
        <x-breadcrumb-item>Articles correspondant à « {{ $q }} »</x-breadcrumb-item>
    </x-breadcrumb>

    <x-section class="container">
        <x-slot:title>
            Articles correspondant à « {{ $q }} »
        </x-slot:title>

        <x-posts-search-form />

        <div class="grid gap-8 mt-8">
            @forelse ($posts as $post)
                <x-post :post="$post" />
            @empty
                <p class="md:col-span-2 text-center text-indigo-300">
                    Il n'y a aucun article correspondant à vos critères.
                </p>
            @endforelse
        </div>
    </x-section>

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
</x-app>
