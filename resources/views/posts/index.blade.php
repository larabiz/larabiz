<x-layout.app title="Blog">
    <x-breadcrumb.container class="mt-16">
        <x-breadcrumb.item>Blog</x-breadcrumb.item>
    </x-breadcrumb.container>

    <x-layout.section class="container">
        <div class="grid gap-8">
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
