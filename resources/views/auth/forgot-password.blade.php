<x-app title="Réinitialiser mon mot de passe">
    <x-section class="sm:max-w-screen-sm">
        <x-slot:title>
            Réinitialiser mon mot de passe
        </x-slot:title>

        <x-form method="POST" action="{{ route('password.email') }}" class="grid gap-4 mt-6">
            <div class="grid">
                <x-label for="email">E-mail</x-label>
                <x-input type="email" id="email" name="email" value="{{ old('email') }}" />
            </div>

            <x-cta type="submit" class="mt-4">Réinitialiser</x-cta>
        </x-form>
    </x-section>
</x-app>
