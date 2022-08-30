<x-app title="Blog">
    <x-breadcrumb class="mt-16">
        <x-breadcrumb-item>Blog</x-breadcrumb-item>
    </x-breadcrumb>

    <x-section class="container">
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
                    "name": "Blog"
                }]
            }
        </script>
    @endpush
</x-app>
