<x-layout.app title="Mon nouveau mot de passe">
    <x-layout.section class="sm:max-w-screen-sm">
        <x-slot:title>
            Confirmez votre mot de passe
        </x-slot:title>

        <x-forms.form method="POST" action="{{ route('password.confirm') }}" class="grid gap-4">
            <div class="grid">
                <x-forms.label for="password">Mot de passe actuel</x-forms.label>
                <x-forms.input type="password" id="password" name="password" required autocomplete="current-password" />
            </div>

            <x-buttons.cta type="submit" class="mt-4">Confirmer</x-buttons.cta>
        </x-forms.form>
    </x-layout.section>
</x-layout.app>
