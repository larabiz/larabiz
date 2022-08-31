<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />

        @vite(['resources/css/app.css'])
    </head>
    <body
        class="bg-gradient-to-r {{ $colors->join(' ') }} font-light grid content-center min-h-screen p-6 relative"
        style="text-shadow: 1px 1px 1px rgba(0, 0, 0, .1)"
    >
        <div>
            <div class="text-2xl">{{ $post->title }}</div>
            <div class="mt-4 line-clamp-3 opacity-75 text-lg">{{ $post->excerpt }}</div>
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/20 via-black/10 to-transparent p-6">
                <x-icon-larabiz-alt class="h-6 inline-block" />
            </div>
        </div>
    </body>
</html>
