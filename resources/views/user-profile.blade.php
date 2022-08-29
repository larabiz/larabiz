<x-layout.app>
    <x-layout.section class="sm:max-w-screen-sm">
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
    </x-layout.section>
</x-layout.app>
