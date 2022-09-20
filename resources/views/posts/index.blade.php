@php
$title = $q
    ? "Articles correspondant à \"$q\""
    : 'Tout sur PHP, Laravel et son ecosystème';
@endphp
<x-app title="{{ $title }}">
    <x-breadcrumb class="container mt-8 sm:mt-16">
        <x-breadcrumb-item>Blog</x-breadcrumb-item>
    </x-breadcrumb>

    <x-section class="container">
        <x-slot:title>
            Tout sur PHP, Laravel et son ecosystème
        </x-slot:title>

        <x-form method="GET" :action="route('posts.index')">
            <label for="q" class="sr-only">Rechercher</label>
            <x-search-field :value="$q" />
        </x-form>

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
