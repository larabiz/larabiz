<x-app>
    <x-section class="container max-w-[1024px]">
        <x-slot:title class="font-bold text-2xl">
            Blog
        </x-slot:title>

        <div class="grid md:grid-cols-2 gap-8 mt-8">
            @foreach ($posts as $post)
                <x-post :post="$post" />
            @endforeach
        </div>

        {{ $posts->links() }}
    </x-section>
</x-app>
