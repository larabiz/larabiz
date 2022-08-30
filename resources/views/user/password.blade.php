<x-app>
    <x-section class="sm:max-w-screen-sm">
        <x-slot:title>
            Mon mot de passe
        </x-slot:title>

        <x-form method="PUT" action="{{ route('user-password.update') }}" class="grid gap-4">
            <div>
                <x-label for="password">Nouveau mot de passe</x-label>
                <x-input type="password" id="password" name="password" required bag="updatePassword" />
            </div>

            <div>
                <x-label for="password-confirmation">Confirmation du nouveau mot de passe</x-label>
                <x-input type="password" id="password-confirmation" name="password_confirmation" required bag="updatePassword" />
            </div>

            <x-action-btn
                type="submit"
                class="mt-4"
                @click="window.fathom?.trackGoal('SPKVSTS8', 0)"
            >
                Modifier mon mot de passe
            </x-action-btn>
        </x-form>
    </x-section>
</x-app>
