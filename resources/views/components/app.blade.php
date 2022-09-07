<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />

        <title>{{ $title ?? config('app.name') }}</title>

        <meta name="description" content="{{ $description ?? '' }}" />
        <meta property="og:description" content="{{ $description ?? '' }}" />
        <meta property="og:image" content="{{ $image ?? secure_asset('img/larabiz-banner.jpg') }}" />
        <meta property="og:title" content="{{ $title ?? config('app.name') }}" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ URL::current() }}" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@Larabiz_" />
        <meta name="twitter:creator" content="@benjamincrozat" />
        <meta name="twitter:description" content="{{ $description ?? '' }}" />
        <meta name="twitter:image" content="{{ $image ?? secure_asset('img/larabiz-banner.jpg') }}" />
        <meta name="twitter:title" content="{{ $title ?? config('app.name') }}" />

        <livewire:styles />

        @vite(['resources/css/app.css'])

        @googlefonts

        <livewire:scripts />

        <script defer src="https://unpkg.com/@alpinejs/intersect@3.10.3/dist/cdn.min.js"></script>
        <script defer src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>

        @vite(['resources/js/app.js'])

        <link rel="canonical" href="{{ $canonical ?? URL::current() }}" />

        <x-feed-links />

        <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png" />
        <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{ secure_asset('img/apple-touch-icon.png') }}" />

        @if (app()->environment('production') && config('app.master_email') !== $user?->email)
            <script defer src="https://enlightenment.larabiz.fr/script.js" data-site="{{ config('services.fathom.site_id') }}"></script>
        @endif
    </head>
    <body class="bg-indigo-50 font-light text-gray-700" x-data>
        @if ($user && ! $user->hasVerifiedEmail())
            <div {{ $attributes->merge(['class' => 'bg-gradient-to-r from-indigo-400 to-indigo-300 py-3 text-sm text-white']) }}>
                <div class="container sm:text-center text-indigo-50">
                    <p class="sm:text-center">Veuillez confirmer votre adresse e-mail afin d'utiliser Larabiz à son plein potentiel.</p>

                    <x-form method="POST" action="{{ route('verification.send') }}" class="mt-2 text-center">
                        <button type="submit" class="bg-white/20 font-normal px-3 py-1 rounded text-white">Renvoyer la confirmation</button>
                    </x-form>
                </div>
            </div>
        @endif

        <div class="flex flex-col min-h-screen">
            <x-main-navigation />

            <main>
                {{ $slot }}
            </main>

            <x-footer class="flex-grow" />
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
