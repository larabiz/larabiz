<x-section {{ $attributes }}>
    <x-slot:title
        tag="{{ $title->attributes->get('tag') ?? 'h1' }}"
        class="font-extrabold !leading-6 md:!leading-9 text-xl md:text-3xl text-center"
    >
        {{ $title }}
    </x-slot>

    <p class="-mt-2 font-regular text-center sm:text-lg">
        {{ config('app.name') }} vous envoie régulièrement<br /> trucs et astuces, ainsi que les dernières offres d'emploi.
    </p>

    <p class="font-bold mt-5 text-center sm:text-lg">
        Rejoignez les @choice('<span class="font-exabold text-indigo-400">:count</span> autre abonné|<span class="font-extrabold text-indigo-400">:count</span> autres abonnés', $subscribersCount)&nbsp;!
    </p>

    <x-forms.form
        method="POST"
        action="{{ route('subscribers.store') }}"
        class="md:max-w-screen-sm mt-8 mx-auto"
        @submit.prevent="window.fathom?.trackGoal('D6LUJ5OX', 0); $el.submit()"
    >
        <div class="flex flex-wrap sm:flex-nowrap items-stretch gap-2 rounded">
            <p class="flex-grow">
                <label for="email" class="sr-only">E-mail :</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="homer@simpson.com" class="dark:bg-gray-700 border-0 placeholder-indigo-200 dark:placeholder-gray-500 px-4 py-3 rounded shadow shadow-indigo-100 dark:shadow-none w-full" required>
            </p>

            <x-buttons.cta type="submit" class="w-full sm:w-auto">
                M'abonner
            </x-buttons.cta>
        </div>

        <x-forms.error name="email" />
    </x-forms.form>

    <p class="md:max-w-screen-sm mt-2 mx-auto text-center text-indigo-400 dark:text-indigo-400/80 text-xs">
        Pas de spam, seulement des nouvelles en rapport avec {{ config('app.name') }}&nbsp;!
    </p>

    {{ $slot }}
</x-layout>
