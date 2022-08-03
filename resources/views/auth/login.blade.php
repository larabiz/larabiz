<x-app title="Connexion">
    <x-section class="sm:max-w-screen-sm">
        <x-slot:title class="font-extrabold leading-tight text-center text-xl">
            Connexion
        </x-slot:title>

        <x-forms.form
            method="POST"
            action="{{ route('login') }}"
            class="grid gap-4 mt-6"
            @submit.prevent="window.fathom?.trackGoal('G24W3KCX', 0); $el.submit()"
        >
            <input type="hidden" name="remember" value="1" />

            <div>
                <x-forms.label for="email">E-mail</x-forms.label>
                <x-forms.input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="homer@simpson.com" required />
            </div>

            <div>
                <x-forms.label for="password" class="flex items-center justify-between mt-2">
                    Mot de passe
                    <a href="{{ route('password.request') }}" class="font-bold text-indigo-400">
                        <x-heroicon-o-question-mark-circle class="h-5" />
                    </a>
                </x-forms.label>

                <x-forms.input type="password" id="password" name="password" required />
            </div>

            <x-buttons.cta
                type="submit"
                class="mt-4"
            >
                Connexion
            </x-buttons.cta>
        </x-forms.form>

        <div class="border-t mt-8 sm:mt-16 pt-8 sm:pt-16 text-center">
            <p>Vous n'avez pas encore de compte sur {{ config('app.name') }}&nbsp;? <a href="{{ route('register') }}" class="font-semibold text-indigo-400" @click="window.fathom?.trackGoal('WNMM2HJ8', 0)">Inscrivez-vous</a>.</p>
        </div>
    </x-section>
</x-app>
