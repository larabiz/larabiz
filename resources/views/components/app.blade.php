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
        @if (session('status'))
            <div
                class="bg-gradient-to-r from-gray-700 to-gray-800 fixed bottom-4 left-1/2 -translate-x-1/2 px-4 py-3 rounded-lg shadow-lg shadow-indigo-900/20 text-white"
                x-data="{ open: true }"
                x-show="open"
            >
                <div class="flex items-center gap-4">
                    <div>{{ session('status') }}</div>

                    <button class="text-indigo-400" @click="open = false">
                        <span class="font-bold sm:sr-only">Fermer</span>
                        <x-heroicon-o-x class="hidden sm:inline w-4 h-4" />
                    </button>
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
    </body>
</html>
