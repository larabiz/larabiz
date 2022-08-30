<x-app title="Mon nouveau mot de passe">
    <x-section class="sm:max-w-screen-sm">
        <x-slot:title>
            Confirmez votre mot de passe
        </x-slot:title>

        <x-form method="POST" action="{{ route('password.confirm') }}" class="grid gap-4">
            <div class="grid">
                <x-label for="password">Mot de passe actuel</x-label>
                <x-input type="password" id="password" name="password" required autocomplete="current-password" />
            </div>

            <x-action-btn type="submit" class="mt-4">Confirmer</x-action-btn>
        </x-form>
    </x-section>
</x-app>
