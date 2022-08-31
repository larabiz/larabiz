<x-app>
    <x-breadcrumb class="mt-16">
        <x-breadcrumb-item>Mes informations</x-breadcrumb-item>
    </x-breadcrumb>

    <x-section class="sm:max-w-screen-sm">
        <x-slot:title>
            Mes informations
        </x-slot:title>

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

            <div>
                <x-label for="github">URL GitHub</x-label>
                <x-input type="url" id="github" name="github" value="{{ old('github') ?? $user->github }}" placeholder="https://github.com/jonathanfrink" bag="updateProfileInformation" />
            </div>

            <div>
                <x-label for="linkedin">URL LinkedIn</x-label>
                <x-input type="url" id="linkedin" name="linkedin" value="{{ old('linkedin') ?? $user->linkedin }}" placeholder="https://www.linkedin.com/in/moeszyslak" bag="updateProfileInformation" />
            </div>

            <x-action-btn
                type="submit"
                class="mt-4"
                @click="window.fathom?.trackGoal('NMBYUHN7', 0)"
            >
                Modifier mes informations
            </x-action-btn>
        </x-form>
    </x-section>
</x-app>
