<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />

        <title>{{ $title ?? config('app.name') }}</title>

        <meta name="description" content="{{ $description ?? '' }}">
        <meta property="og:description" content="{{ $description ?? '' }}">
        <meta property="og:image" content="{{ $image ?? secure_asset('img/larabiz-banner.jpg') }}">
        <meta property="og:title" content="{{ $title ?? config('app.name') }}">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ URL::current() }}">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:creator" content="@Larabiz_">
        <meta name="twitter:description" content="{{ $description ?? '' }}">
        <meta name="twitter:image" content="{{ $image ?? secure_asset('img/larabiz-banner.jpg') }}">
        <meta name="twitter:title" content="{{ $title ?? config('app.name') }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @googlefonts

        <link rel="canonical" href="{{ $canonical ?? URL::current() }}" />

        <link rel="apple-touch-icon" sizes="180x180" href="{{ secure_asset('img/apple-touch-icon.png') }}">

        @if (app()->isProduction() && auth()->id() !== 1)
            <script defer src="https://enlightenment.larabiz.fr/script.js" data-site="{{ config('services.fathom.site_id') }}"></script>
        @endif
    </head>
    <body class="bg-indigo-50 text-gray-700" x-data>
        @if (auth()->check() && ! auth()->user()->hasVerifiedEmail())
            <div class="bg-gradient-to-r from-indigo-400 to-indigo-300 font-semibold py-3 text-center text-sm text-white">
                <div class="container">
                    <div>Veuillez confirmer votre adresse e-mail afin d'utiliser Larabiz à son plein potentiel.</div>

                    <x-form method="POST" action="{{ route('verification.send') }}" class="mt-2">
                        <button type="submit" class="bg-white/20 font-bold px-3 py-1 rounded">Renvoyer la confirmation</button>
                    </x-form>
                </div>
            </div>
        @endif

        <div class="flex flex-col min-h-screen">
            <x-nav />

            <main>
                {{ $slot }}
            </main>

            <x-footer class="bg-indigo-100 flex-grow" />
        </div>

        <x-status />
    </body>
</html>
