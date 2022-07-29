<x-app>
    <x-section class="sm:max-w-screen-sm">
        <x-slot:title>
            Mon profil
        </x-slot:title>

        <h2 class="font-extrabold leading-tight my-8 text-center">
            Mes informations
        </h2>

        <x-form method="PUT" action="{{ route('user-profile-information.update') }}" class="grid gap-4">
            <div>
                <x-label for="username">Nom d'utilisateur</x-label>
                <x-input id="username" name="username" value="{{ old('username') ?? $user->username }}" placeholder="Monsieur X, El Barto, etc." required bag="updateProfileInformation" />
            </div>

            <div>
                <x-label for="email">E-mail</x-label>
                <x-input type="email" id="email" name="email" value="{{ old('email') ?? $user->email }}" placeholder="bart@simpson.com" required bag="updateProfileInformation" />
            </div>

            <div>
                <x-label for="biography">Biographie</x-label>

                <x-textarea
                    id="biography"
                    name="biography"
                    value="{{ old('biography') ?? $user->biography }}"
                >{{ old('biography') ?? $user->biography }}</x-textarea>
            </div>

            <p class="font-bold mb-4 mt-8 text-center">
                Et si Larabiz ouvrait un espace pour de potentiels employeurs, où pourraient-ils en apprendre plus sur votre parcours et vos compétences&nbsp;?
            </p>

            <div>
                <x-label for="github">URL GitHub</x-label>
                <x-input type="url" id="github" name="github" value="{{ old('github') ?? $user->github }}" placeholder="https://github.com/jonathanfrink" bag="updateProfileInformation" />
            </div>

            <div>
                <x-label for="linkedin">URL LinkedIn</x-label>
                <x-input type="url" id="linkedin" name="linkedin" value="{{ old('linkedin') ?? $user->linkedin }}" placeholder="https://www.linkedin.com/in/moeszyslak" bag="updateProfileInformation" />
            </div>

            <x-cta
                type="submit"
                class="mt-4"
                @click="window.fathom?.trackGoal('NMBYUHN7', 0)"
            >
                Modifier mes informations
            </x-cta>
        </x-form>

        <h2 class="border-t border-indigo-100 font-extrabold leading-tight mb-8 mt-16 pt-16 text-center">Mon mot de passe</h2>

        <x-form method="PUT" action="{{ route('user-password.update') }}" class="grid gap-4">
            <div>
                <x-label for="current-password">Mot de passe actuel</x-label>
                <x-input type="password" id="current-password" name="current_password" bag="updatePassword" />
            </div>

            <div>
                <x-label for="password">Nouveau mot de passe</x-label>
                <x-input type="password" id="password" name="password" bag="updatePassword" />
            </div>

            <div>
                <x-label for="password-confirmation">Confirmation du nouveau mot de passe</x-label>
                <x-input type="password" id="password-confirmation" name="password_confirmation" bag="updatePassword" />
            </div>

            <x-cta
                type="submit"
                class="mt-4"
                @click="window.fathom?.trackGoal('SPKVSTS8', 0)"
            >
                Modifier mon mot de passe
            </x-cta>
        </x-form>
    </x-section>
</x-app>
