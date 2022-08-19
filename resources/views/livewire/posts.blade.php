<div class="mt-8 sm:mt-16">
    <div class="sm:max-w-screen-sm sm:mx-auto">
        <input
            type="search"
            wire:model="search"
            placeholder="Rechercher"
            class="bg-white/75 focus:bg-white border-0 placeholder-indigo-200/75 mt-1 px-4 py-2 rounded-full shadow shadow-indigo-100 text-sm transition-colors w-full"
            @input.throttle.3000ms="window.fathom.trackGoal('DJOBX1N1', 0)"
        />
    </div>

    <div class="grid md:grid-cols-2 gap-8 mt-8">
        @forelse ($posts as $post)
            <x-posts.post :post="$post" />
        @empty
            <p class="col-span-2 text-center text-indigo-300">Il n'y a aucun article correspondant à vos critères.</p>
        @endforelse
    </div>
</div>
