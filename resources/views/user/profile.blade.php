<x-app>
    <x-section class="sm:max-w-screen-sm">
        <x-slot:title>
            Mon profil
        </x-slot:title>

        <h2 class="font-extrabold leading-tight my-8 text-center">Mes informations</h2>

        <x-form method="PUT" action="{{ route('user-profile-information.update') }}" class="grid gap-4">
            <div class="grid">
                <label for="username" class="font-bold">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" value="{{ old('username') ?? $user->username }}" placeholder="Bart Simpson, Monsieur X, El Barto, etc." required class="bg-white/75 focus:bg-white border-0 placeholder-indigo-200/75 mt-1 px-4 py-3 rounded shadow shadow-indigo-100 transition-colors w-full" />
                <x-error name="username" bag="updateProfileInformation" />
            </div>

            <div class="grid">
                <label for="email" class="font-bold">E-mail</label>
                <input type="email" id="email" name="email" value="{{ old('email') ?? $user->email }}" placeholder="bart@simpson.com" required class="bg-white/75 focus:bg-white border-0 placeholder-indigo-200/75 mt-1 px-4 py-3 rounded shadow shadow-indigo-100 transition-colors w-full" />
                <x-error name="email" bag="updateProfileInformation" />
            </div>

            <div class="grid">
                <label for="github" class="font-bold">URL GitHub</label>
                <input type="url" id="github" name="github" value="{{ old('github') ?? $user->github }}" placeholder="https://github.com/jonathanfrink" class="bg-white/75 focus:bg-white border-0 placeholder-indigo-200/75 mt-1 px-4 py-3 rounded shadow shadow-indigo-100 transition-colors w-full" />
                <x-error name="github" bag="updateProfileInformation" />
            </div>

            <div class="grid">
                <label for="linkedin" class="font-bold">URL LinkedIn</label>
                <input type="url" id="linkedin" name="linkedin" value="{{ old('linkedin') ?? $user->linkedin }}" placeholder="https://linkedin.com/in/moeszyslak" class="bg-white/75 focus:bg-white border-0 placeholder-indigo-200/75 mt-1 px-4 py-3 rounded shadow shadow-indigo-100 transition-colors w-full" />
                <x-error name="linkedin" bag="updateProfileInformation" />
            </div>

            <div class="grid">
                <label for="biography" class="font-bold">Biographie</label>
                <textarea id="biography" name="biography" value="{{ old('biography') ?? $user->biography }}" placeholder="" class="bg-white/75 focus:bg-white border-0 h-40 mt-1 placeholder-indigo-200/75 px-4 py-3 resize-none rounded shadow shadow-indigo-100 transition-colors w-full">{{ old('biography') ?? $user->biography }}</textarea>
                <x-error name="biography" bag="updateProfileInformation" />
            </div>

            <x-cta type="submit" class="mt-4">Modifier mes informations</x-cta>
        </x-form>

        <h2 class="border-t border-indigo-100 font-extrabold leading-tight mb-8 mt-16 pt-16 text-center">Mon mot de passe</h2>

        <x-form method="PUT" action="{{ route('user-password.update') }}" class="grid gap-4">
            <div class="grid">
                <label for="current-password" class="font-bold">Mot de passe actuel</label>
                <input type="password" id="current-password" name="current_password" required class="bg-white/75 focus:bg-white border-0 mt-1 placeholder-indigo-200/75 px-4 py-3 rounded shadow shadow-indigo-100 transition-colors w-full" />
                <x-error name="current_password" bag="updatePassword" />
            </div>

            <div class="grid">
                <label for="password" class="font-bold">Nouveau mot de passe</label>
                <input type="password" id="password" name="password" required class="bg-white/75 focus:bg-white border-0 mt-1 placeholder-indigo-200/75 px-4 py-3 rounded shadow shadow-indigo-100 transition-colors w-full" />
                <x-error name="password" bag="updatePassword" />
            </div>

            <div class="grid">
                <label for="password-confirmation" class="font-bold">Confirmation du nouveau mot de passe</label>
                <input type="password" id="password-confirmation" name="password_confirmation" required class="bg-white/75 focus:bg-white border-0 mt-1 placeholder-indigo-200/75 px-4 py-3 rounded shadow shadow-indigo-100 transition-colors w-full" />
                <x-error name="password_confirmation" bag="updatePassword" />
            </div>

            <x-cta type="submit" class="mt-4">Modifier mon mot de passe</x-cta>
        </x-form>
    </x-section>
</x-app>
