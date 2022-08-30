<x-app title="Réinitialiser mon mot de passe">
    <x-breadcrumb class="mt-16">
        <x-breadcrumb-item>Réinitialiser mon mot de passe</x-breadcrumb-item>
    </x-breadcrumb>

    <div class="container sm:max-w-screen-sm pt-8 sm:pt-16 pb-8 sm:py-16">
        <h1 class="font-extrabold leading-tight text-center text-xl">
            Réinitialiser mon mot de passe
        </h1>

        <x-form method="POST" action="{{ route('password.email') }}" class="grid gap-4 mt-6">
            <div class="grid">
                <x-label for="email">E-mail</x-label>
                <x-input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="lennyetcarl@pourlavie.com" />
            </div>

            <x-action-btn type="submit">Réinitialiser</x-action-btn>
        </x-form>
    </div>

    @push('scripts')
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "BreadcrumbList",
                "itemListElement": [{
                    "@type": "ListItem",
                    "position": 1,
                    "name": "Réinitialiser mon mot de passe"
                }]
            }
        </script>
    @endpush
</x-app>
