<x-section {{ $attributes }}>
    <x-slot:title tag="{{ $title->attributes->get('tag') ?? 'h1' }}" class="font-extrabold !leading-6 md:!leading-9 text-xl md:text-3xl text-center">
        {{ $title }}
    </x-slot>

    <p class="mt-5 text-center sm:text-lg md:text-xl">
        <strong class="bg-purple-200">Tous les lundis</strong>, Larabiz vous envoie <strong class="bg-purple-200">gratuitement</strong> les dernières opportunités.
    </p>

    <x-form method="POST" action="{{ route('subscribers.store') }}" class="md:max-w-screen-sm mt-8 mx-auto">
        <div class="flex flex-wrap sm:flex-nowrap items-stretch gap-2 rounded">
            <p class="flex-grow">
                <label for="email" class="sr-only">E-mail :</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="homer@simpson.com" class="border-0 placeholder-indigo-200 px-4 py-3 rounded shadow shadow-indigo-100 w-full" required>
            </p>

            <x-cta type="submit" class="w-full sm:w-auto">M'abonner</x-cta>
        </div>

        <x-error name="email" />
    </x-form>

    <p class="md:max-w-screen-sm mt-2 mx-auto text-center text-indigo-400 text-xs">
        Pas de spam, seulement des nouvelles en rapport avec Larabiz !
    </p>

    {{ $slot }}
</x-layout>
