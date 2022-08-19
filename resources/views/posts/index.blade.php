<x-layout.app title="Blog">
    <x-breadcrumb.container class="mt-16">
        <x-breadcrumb.item>Blog</x-breadcrumb.item>
    </x-breadcrumb.container>

    <x-layout.section class="container">
        <livewire:posts />
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
