<x-app
    title="Réinitialiser mon mot de passe"
    description="Mot de passe oublié ? Ce sont des choses qui arrivent et ce n'est pas grave. Réinitialisez tout simplement votre mot de passe."
>
    <div class="container sm:max-w-screen-sm pt-16 pb-8 sm:py-16">
        <div class="text-center">
            <x-icon-forgot class="flex-shrink-0 inline w-40 h-40" />
        </div>

        <div class="mt-8 sm:mt-16">
            <h1 class="font-extrabold leading-tight text-center text-xl">
                Réinitialiser mon mot de passe
            </h1>

            <x-forms.form method="POST" action="{{ route('password.email') }}" class="grid gap-4 mt-6">
                <div class="grid">
                    <x-forms.label for="email">E-mail</x-forms.label>
                    <x-forms.input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="lennyetcarl@pourlavie.com" />
                </div>

                <x-buttons.cta type="submit">Réinitialiser</x-buttons.cta>
            </x-forms.form>
        </div>
    </div>
</x-app>
