<x-app title="Connexion">
    <x-breadcrumb class="container mt-8 sm:mt-16">
        <x-breadcrumb-item>Connexion</x-breadcrumb-item>
    </x-breadcrumb>

    <x-section class="sm:max-w-screen-sm">
        <x-slot:title class="font-extrabold leading-tight text-center text-xl">
            Connexion
        </x-slot:title>

        <x-form
            method="POST"
            action="{{ route('login') }}"
            class="grid gap-4 mt-6"
            @submit.prevent="window.fathom?.trackGoal('G24W3KCX', 0); $el.submit()"
        >
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

            <x-action-btn
                type="submit"
                class="mt-4"
            >
                Connexion
            </x-action-btn>
        </x-form>

        <div class="border-t mt-8 sm:mt-16 pt-8 sm:pt-16 text-center">
            <p>Vous n'avez pas encore de compte sur {{ config('app.name') }}&nbsp;? <a href="{{ route('register') }}" class="font-semibold text-indigo-400" @click="window.fathom?.trackGoal('WNMM2HJ8', 0)">Inscrivez-vous</a>.</p>
        </div>
    </x-section>

    @push('scripts')
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "BreadcrumbList",
                "itemListElement": [{
                    "@type": "ListItem",
                    "position": 1,
                    "name": "Connexion"
                }]
            }
        </script>
    @endpush
</x-app>
