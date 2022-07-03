<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />

        <title>{{ $title ?? config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @googlefonts
    </head>
    <body class="bg-indigo-50 text-gray-700">
        <div class="flex flex-col min-h-screen">
            <x-nav />

            <main>
                {{ $slot }}
            </main>

            <footer class="bg-indigo-100 flex-grow">
            </footer>
        </div>
    </body>
</html>
