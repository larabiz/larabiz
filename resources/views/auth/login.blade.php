<x-app title="Connexion">
    <x-section class="sm:max-w-screen-sm">
        <x-slot:title class="font-extrabold leading-tight text-center text-xl">
            Connexion
        </x-slot:title>

        <x-form method="POST" action="{{ route('login') }}" class="grid gap-4 mt-6">
            <input type="hidden" name="remember" value="1" />

            <div>
                <x-label for="email">E-mail</x-label>
                <x-input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="homer@simpson.com" required />
            </div>

            <div>
                <x-label for="password" class="flex items-center justify-between mt-2">
                    Mot de passe
                    <a href="{{ route('password.request') }}" class="font-bold text-indigo-400">
                        <x-heroicon-o-question-mark-circle class="h-5" />
                    </a>
                </x-label>

                <x-input type="password" id="password" name="password" required />
            </div>

            <x-cta type="submit" class="mt-4">Connexion</x-cta>
        </x-form>
    </x-section>
</x-app>
