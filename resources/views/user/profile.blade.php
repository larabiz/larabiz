<x-layout.app>
    <x-section class="sm:max-w-screen-sm">
        <x-slot:title>
            Mon profil
        </x-slot:title>

        <h2 class="font-extrabold leading-tight my-8 text-center">
            Mes informations
        </h2>

        <x-forms.form method="PUT" action="{{ route('user-profile-information.update') }}" class="grid gap-4">
            <div>
                <x-forms.label for="username">Nom d'utilisateur</x-forms.label>
                <x-forms.input id="username" name="username" value="{{ old('username') ?? $user->username }}" placeholder="Monsieur X, El Barto, etc." required bag="updateProfileInformation" />
            </div>

            <div>
                <x-forms.label for="email">E-mail</x-forms.label>
                <x-forms.input type="email" id="email" name="email" value="{{ old('email') ?? $user->email }}" placeholder="bart@simpson.com" required bag="updateProfileInformation" />
            </div>

            <div>
                <x-forms.label for="biography">Biographie</x-forms.label>

                <x-forms.textarea
                    id="biography"
                    name="biography"
                    value="{{ old('biography') ?? $user->biography }}"
                >{{ old('biography') ?? $user->biography }}</x-forms.textarea>
            </div>

            <p class="font-bold mb-4 mt-8 text-center">
                Et si Larabiz ouvrait un espace pour de potentiels employeurs, où pourraient-ils en apprendre plus sur votre parcours et vos compétences&nbsp;?
            </p>

            <div>
                <x-forms.label for="github">URL GitHub</x-forms.label>
                <x-forms.input type="url" id="github" name="github" value="{{ old('github') ?? $user->github }}" placeholder="https://github.com/jonathanfrink" bag="updateProfileInformation" />
            </div>

            <div>
                <x-forms.label for="linkedin">URL LinkedIn</x-forms.label>
                <x-forms.input type="url" id="linkedin" name="linkedin" value="{{ old('linkedin') ?? $user->linkedin }}" placeholder="https://www.linkedin.com/in/moeszyslak" bag="updateProfileInformation" />
            </div>

            <x-buttons.cta
                type="submit"
                class="mt-4"
                @click="window.fathom?.trackGoal('NMBYUHN7', 0)"
            >
                Modifier mes informations
            </x-buttons.cta>
        </x-forms.form>

        <h2 class="border-t border-indigo-100 font-extrabold leading-tight mb-8 mt-16 pt-16 text-center">Mon mot de passe</h2>

        <x-forms.form method="PUT" action="{{ route('user-password.update') }}" class="grid gap-4">
            <div>
                <x-forms.label for="current-password">Mot de passe actuel</x-forms.label>
                <x-forms.input type="password" id="current-password" name="current_password" required bag="updatePassword" />
            </div>

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
    </x-section>
</x-app>
