<x-app title="Inscription">
    <x-breadcrumb class="container mt-8 sm:mt-16">
        <x-breadcrumb-item>Inscription</x-breadcrumb-item>
    </x-breadcrumb>

    <x-section class="sm:max-w-screen-sm">
        <x-slot:title>
            Inscription
        </x-slot:title>

        <x-form
            method="POST"
            action="{{ route('register') }}"
            class="grid gap-4"
            @submit.prevent="window.fathom?.trackGoal('G5KSDX2H', 0); $el.submit()"
        >
            <div class="grid">
                <x-label for="username">Nom d'utilisateur</x-label>
                <x-input id="username" name="username" value="{{ old('username') }}" placeholder="Monsieur X, El Barto, etc." required />
            </div>

            <div class="grid">
                <x-label for="email">E-mail</x-label>
                <x-input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="bart@simpson.com" required />
            </div>

            <div class="grid">
                <x-label for="password">Mot de passe</x-label>
                <x-input type="password" id="password" name="password" required />
            </div>

            <div class="grid">
                <x-label for="password-confirmation">Confirmation du mot de passe</x-label>
                <x-input type="password" id="password-confirmation" name="password_confirmation" required />
            </div>

            <x-action-btn
                type="submit"
                class="mt-4"
            >
                Inscription
            </x-action-btn>
        </x-form>

        <div class="border-t mt-8 sm:mt-16 pt-8 sm:pt-16 text-center">
            <p>Avez-vous déjà un compte sur {{ config('app.name') }}&nbsp;? <a href="{{ route('login') }}" class="font-semibold text-indigo-400" @click="window.fathom?.trackGoal('SRUCVXXS', 0)">Connectez-vous</a>.</p>
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
                    "name": "Inscription"
                }]
            }
        </script>
    @endpush
</x-app>
