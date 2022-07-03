<a href="{{ route('posts.show') }}" class="bg-white bg-opacity-[.35] flex flex-col rounded-3xl shadow-lg shadow-indigo-200/50">
    <img src="https://larabiz.fr/storage/o3IbbaKgpgXPTy2m1FxLd1xDogNcVJwHKf62GX8a.jpg" class="rounded-3xl" />

    <div class="flex flex-col flex-grow p-6">
        <div class="font-bold leading-tight text-indigo-900 text-xl">
            {{ fake()->sentence() }}
        </div>

        <div class="flex-grow line-clamp-2 mt-2 text-indigo-900 text-opacity-75">
            {{ fake()->paragraph(mt_rand(1, 3)) }}
        </div>
    </div>
</a>
