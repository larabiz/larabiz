<x-layout.section {{ $attributes }}>
    <x-slot:title
        tag="{{ $headline->attributes->get('tag') ?? 'h1' }}"
        class="font-extrabold !leading-6 md:!leading-9 text-xl md:text-3xl text-center"
    >
        {{ $headline }}
    </x-slot>

    <p class="-mt-2 font-regular md:max-w-screen-sm md:mx-auto text-center sm:text-lg">
        {{ $subheadline }}
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
                <label for="email" class="sr-only">
                    E-mail :
                </label>

                <x-forms.input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="homer@simpson.com"
                    required
                    class="!mt-0"
                />
            </p>

            <x-buttons.cta type="submit" class="w-full sm:w-auto">
                M'abonner
            </x-buttons.cta>
        </div>

        <x-forms.error name="email" />
    </x-forms.form>

    <p class="md:max-w-screen-sm mt-2 mx-auto text-center text-indigo-400 text-xs">
        Pas de spam, c'est promis&nbsp;!
    </p>

    {{ $slot }}
</x-layout.section>
