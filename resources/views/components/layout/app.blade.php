<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />

        <title>{{ $title ?? config('app.name') }}</title>

        <meta name="description" content="{{ $seoDescription ?? $description ?? '' }}" />
        <meta property="og:description" content="{{ $seoDescription ?? $description ?? '' }}" />
        <meta property="og:image" content="{{ $image ?? secure_asset('img/larabiz-banner.jpg') }}" />
        <meta property="og:title" content="{{ $seoTitle ?? $title ?? config('app.name') }}" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ URL::current() }}" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@Larabiz_" />
        <meta name="twitter:creator" content="@benjamincrozat" />
        <meta name="twitter:description" content="{{ $seoDescription ?? $description ?? '' }}" />
        <meta name="twitter:image" content="{{ $image ?? secure_asset('img/larabiz-banner.jpg') }}" />
        <meta name="twitter:title" content="{{ $seoTitle ?? $title ?? config('app.name') }}" />

        <livewire:styles />

        @vite(['resources/css/app.css'])

        @googlefonts

        <livewire:scripts />

        <script defer src="https://unpkg.com/@alpinejs/intersect@3.10.3/dist/cdn.min.js"></script>
        <script defer src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>

        @vite(['resources/js/app.js'])

        <link rel="canonical" href="{{ $canonical ?? URL::current() }}" />

        <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png" />
        <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{ secure_asset('img/apple-touch-icon.png') }}" />

        @if (app()->isProduction() && 'benjamincrozat@me.com' !== $user?->email)
            <script defer src="https://enlightenment.larabiz.fr/script.js" data-site="{{ config('services.fathom.site_id') }}"></script>
        @endif
    </head>
    <body class="bg-indigo-50 font-light text-gray-700" x-data>
        @if ($user && ! $user->hasVerifiedEmail())
            <div {{ $attributes->merge(['class' => 'bg-gradient-to-r from-indigo-400 to-indigo-300 font-semibold py-3 text-center text-sm text-white']) }}>
                <div class="container">
                    <p>Veuillez confirmer votre adresse e-mail afin d'utiliser Larabiz à son plein potentiel.</p>

                    <x-forms.form method="POST" action="{{ route('verification.send') }}" class="mt-2">
                        <button type="submit" class="bg-white/20 font-bold px-3 py-1 rounded">Renvoyer la confirmation</button>
                    </x-forms.form>
                </div>
            </div>
        @endif

        <div class="flex flex-col min-h-screen">
            <x-layout.nav />

            <main>
                {{ $slot }}
            </main>

            <x-layout.footer class="flex-grow" />
        </div>

        <x-status />

        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Organization",
                "url": "{{ url('/') }}",
                "logo": "{{ secure_asset('img/larabiz.png') }}"
            }
        </script>

        @stack('scripts')
    </body>
</html>
