<x-section {{ $attributes }}>
    <x-slot:title
        tag="{{ $headline->attributes->get('tag') ?? 'h1' }}"
        class="font-extrabold !leading-6 md:!leading-9 text-xl md:text-3xl text-center"
    >
        {{ $headline }}
    </x-slot>

    <p class="-mt-2 font-regular md:max-w-screen-sm md:mx-auto text-center sm:text-lg">
        {{ $subheadline }}
    </p>

    <x-form
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

                <x-input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="homer@simpson.com"
                    required
                    class="!mt-0"
                    error-disabled="true"
                />
            </p>

            <x-action-btn type="submit" class="w-full sm:w-auto">
                M'abonner
            </x-action-btn>
        </div>

        <x-error name="email" class="!block text-center" />
    </x-form>

    {{ $slot }}
</x-section>
