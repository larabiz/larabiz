<x-layout.app>
    <x-layout.section class="sm:max-w-screen-sm">
        <x-slot:title>
            Mon mot de passe
        </x-slot:title>

        <x-forms.form method="PUT" action="{{ route('user-password.update') }}" class="grid gap-4">
            <div>
                <x-forms.label for="password">Nouveau mot de passe</x-forms.label>
                <x-forms.input type="password" id="password" name="password" required bag="updatePassword" />
            </div>

            <div>
                <x-forms.label for="password-confirmation">Confirmation du nouveau mot de passe</x-forms.label>
                <x-forms.input type="password" id="password-confirmation" name="password_confirmation" required bag="updatePassword" />
            </div>

            <x-buttons.cta
                type="submit"
                class="mt-4"
                @click="window.fathom?.trackGoal('SPKVSTS8', 0)"
            >
                Modifier mon mot de passe
            </x-buttons.cta>
        </x-forms.form>
    </x-layout.section>
</x-layout.app>
