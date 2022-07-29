<x-app title="Réinitialiser mon mot de passe">
    <div class="container sm:max-w-screen-sm pt-16 pb-8 sm:py-16">
        <div class="text-center">
            <x-icon-forgot class="flex-shrink-0 inline w-40 h-40" />
        </div>

        <div class="mt-8 sm:mt-16">
            <h2 class="font-extrabold leading-tight text-center text-xl">
                Réinitialiser mon mot de passe
            </h2>

            <x-form method="POST" action="{{ route('password.email') }}" class="grid gap-4 mt-6">
                <div class="grid">
                    <x-label for="email">E-mail</x-label>
                    <x-input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="lennyetcarl@pourlavie.com" />
                </div>

                <x-cta type="submit">Réinitialiser</x-cta>
            </x-form>
        </div>
    </div>
</x-app>
