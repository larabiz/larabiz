<x-app title="Inscription">
    <x-section class="sm:max-w-screen-sm">
        <x-slot:title>
            Inscription
        </x-slot:title>

        <x-form method="POST" action="{{ route('register') }}" class="grid gap-4">
            <div class="grid">
                <x-label for="username">Nom d'utilisateur</x-label>
                <x-input id="username" name="username" value="{{ old('username') }}" placeholder="Monsieur X, El Barto, etc." required />
            </div>

            <div class="grid">
                <x-label for="email">E-mail</x-label>
                <x-input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="bart@simpson.com" required />
            </div>

            <div class="grid">
                <x-label for="password">Mot de passe</x-label>
                <x-input type="password" id="password" name="password" required />
            </div>

            <div class="grid">
                <x-label for="password-confirmation">Confirmation du mot de passe</x-label>
                <x-input type="password" id="password-confirmation" name="password_confirmation" required />
            </div>

            <x-cta type="submit" class="mt-4">Inscription</x-cta>
        </x-form>
    </x-section>
</x-app>
