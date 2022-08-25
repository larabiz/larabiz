<x-layout.app title="Inscription">
    <x-breadcrumb.container class="mt-16">
        <x-breadcrumb.item>Inscription</x-breadcrumb.item>
    </x-breadcrumb.container>

    <x-layout.section class="sm:max-w-screen-sm">
        <x-slot:title>
            Inscription
        </x-slot:title>

        <x-forms.form
            method="POST"
            action="{{ route('register') }}"
            class="grid gap-4"
            @submit.prevent="window.fathom?.trackGoal('G5KSDX2H', 0); $el.submit()"
        >
            <div class="grid">
                <x-forms.label for="username">Nom d'utilisateur</x-forms.label>
                <x-forms.input id="username" name="username" value="{{ old('username') }}" placeholder="Monsieur X, El Barto, etc." required />
            </div>

            <div class="grid">
                <x-forms.label for="email">E-mail</x-forms.label>
                <x-forms.input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="bart@simpson.com" required />
            </div>

            <div class="grid">
                <x-forms.label for="password">Mot de passe</x-forms.label>
                <x-forms.input type="password" id="password" name="password" required />
            </div>

            <div class="grid">
                <x-forms.label for="password-confirmation">Confirmation du mot de passe</x-forms.label>
                <x-forms.input type="password" id="password-confirmation" name="password_confirmation" required />
            </div>

            <x-buttons.cta
                type="submit"
                class="mt-4"
            >
                Inscription
            </x-buttons.cta>
        </x-forms.form>

        <div class="border-t mt-8 sm:mt-16 pt-8 sm:pt-16 text-center">
            <p>Avez-vous déjà un compte sur {{ config('app.name') }}&nbsp;? <a href="{{ route('login') }}" class="font-semibold text-indigo-400" @click="window.fathom?.trackGoal('SRUCVXXS', 0)">Connectez-vous</a>.</p>
        </div>
    </x-layout.section>

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
</x-layout.app>
