<x-layout.app title="Mon nouveau mot de passe">
    <x-layout.section class="sm:max-w-screen-sm">
        <x-slot:title>
            Mon nouveau mot de passe
        </x-slot:title>

        <x-forms.form method="POST" action="{{ route('password.update') }}" class="grid gap-4">
            <input type="hidden" name="token" value="{{ $request->route('token') }}" />

            <div class="grid">
                <x-forms.label for="email">E-mail</x-forms.label>
                <x-forms.input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="bart@simpson.com" required />
            </div>

            <div class="grid">
                <x-forms.label for="password">Nouveau mot de passe</x-forms.label>
                <x-forms.input type="password" id="password" name="password" required />
            </div>

            <div class="grid">
                <x-forms.label for="password-confirmation">Confirmation du nouveau mot de passe</x-forms.label>
                <x-forms.input type="password" id="password-confirmation" name="password_confirmation" required />
            </div>

            <x-buttons.cta type="submit" class="mt-4">Valider</x-buttons.cta>
        </x-forms.form>
    </x-layout.section>
</x-layout.app>
