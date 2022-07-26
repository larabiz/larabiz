<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />

        <title>{{ $title ?? config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @googlefonts

        @if (app()->isProduction() && auth()->id() !== 1)
            <script defer src="https://enlightenment.larabiz.fr/script.js" data-site="{{ config('services.fathom.site_id') }}"></script>
        @endif
    </head>
    <body class="bg-indigo-50 text-gray-700">
        <x-notification />

        <div class="flex flex-col min-h-screen">
            <x-nav />

            <main>
                {{ $slot }}
            </main>

            <x-footer class="bg-indigo-100 flex-grow" />
        </div>
    </body>
</html>
