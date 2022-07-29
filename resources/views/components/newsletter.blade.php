<x-section {{ $attributes }}>
    <x-slot:title
        tag="{{ $title->attributes->get('tag') ?? 'h1' }}"
        class="font-extrabold !leading-6 md:!leading-9 text-xl md:text-3xl text-center"
    >
        {{ $title }}
    </x-slot>

    <p class="mt-5 text-center sm:text-lg">
        <strong class="bg-purple-200 font-semibold">Tous les lundis</strong>, {{ config('app.name') }} vous envoie <strong class="bg-purple-200 font-semibold">gratuitement</strong> les dernières opportunités.
    </p>

    <p class="text-center sm:text-lg">
        Rejoignez les <strong class="font-semibold">@choice('<span class="font-extrabold text-indigo-400">:count</span> autre abonné|<span class="font-bold text-indigo-400">:count</span> autres abonnés', $subscribersCount)</strong>&nbsp;!
    </p>

    <x-form
        method="POST"
        action="{{ route('subscribers.store') }}"
        class="md:max-w-screen-sm mt-8 mx-auto"
        @submit.prevent="window.fathom?.trackGoal('D6LUJ5OX', 0); $el.submit()"
    >
        <div class="flex flex-wrap sm:flex-nowrap items-stretch gap-2 rounded">
            <p class="flex-grow">
                <label for="email" class="sr-only">E-mail :</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="homer@simpson.com" class="border-0 placeholder-indigo-200 px-4 py-3 rounded shadow shadow-indigo-100 w-full" required>
            </p>

            <x-cta type="submit" class="w-full sm:w-auto">
                M'abonner
            </x-cta>
        </div>

        <x-error name="email" />
    </x-form>

    <p class="md:max-w-screen-sm mt-2 mx-auto text-center text-indigo-400 text-xs">
        Pas de spam, seulement des nouvelles en rapport avec {{ config('app.name') }}&nbsp;!
    </p>

    {{ $slot }}
</x-layout>
