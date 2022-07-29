<x-app title="Mon nouveau mot de passe">
    <x-section class="sm:max-w-screen-sm">
        <x-slot:title>
            Mon nouveau mot de passe
        </x-slot:title>

        <x-form method="POST" action="{{ route('password.update') }}" class="grid gap-4">
            <input type="hidden" name="token" value="{{ $request->route('token') }}" />

            <div class="grid">
                <x-label for="email">E-mail</x-label>
                <x-input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="bart@simpson.com" required />
            </div>

            <div class="grid">
                <x-label for="password">Nouveau mot de passe</x-label>
                <x-input type="password" id="password" name="password" required />
            </div>

            <div class="grid">
                <x-label for="password-confirmation">Confirmation du nouveau mot de passe</x-label>
                <x-input type="password" id="password-confirmation" name="password_confirmation" required />
            </div>

            <x-cta type="submit" class="mt-4">Valider</x-cta>
        </x-form>
    </x-section>
</x-app>
