<x-app>
    <x-section class="sm:max-w-screen-sm">
        <x-slot:title>
            Inscription
        </x-slot:title>

        <x-form method="POST" action="{{ route('register') }}" class="grid gap-4">
            <div class="grid">
                <label for="username" class="font-bold">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Bart Simpson, Monsieur X, El Barto, etc." required class="bg-white/75 focus:bg-white border-0 placeholder-indigo-200/75 mt-1 px-4 py-3 rounded shadow shadow-indigo-100 transition-colors w-full" />
                <x-error name="username" />
            </div>

            <div class="grid">
                <label for="email" class="font-bold">E-mail</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="bart@simpson.com" required class="bg-white/75 focus:bg-white border-0 placeholder-indigo-200/75 mt-1 px-4 py-3 rounded shadow shadow-indigo-100 transition-colors w-full" />
                <x-error name="email" />
            </div>

            <div class="grid">
                <label for="password" class="font-bold">Mot de passe</label>
                <input type="password" id="password" name="password" required class="bg-white/75 focus:bg-white border-0 mt-1 placeholder-indigo-200/75 px-4 py-3 rounded shadow shadow-indigo-100 transition-colors w-full" />
                <x-error name="password" />
            </div>

            <div class="grid">
                <label for="password-confirmation" class="font-bold">Confirmation du mot de passe</label>
                <input type="password" id="password-confirmation" name="password_confirmation" required class="bg-white/75 focus:bg-white border-0 mt-1 placeholder-indigo-200/75 px-4 py-3 rounded shadow shadow-indigo-100 transition-colors w-full" />
                <x-error name="password_confirmation" />
            </div>

            <x-cta type="submit" class="mt-4">Inscription</x-cta>
        </x-form>
    </x-section>
</x-app>
