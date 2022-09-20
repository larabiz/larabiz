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
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" /></svg>

                        <span class="sr-only">Mot de passe oublié ?</span>
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
