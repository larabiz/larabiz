<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />

        @vite(['resources/css/app.css'])
    </head>
    <body class="bg-indigo-50 font-light grid content-center min-h-screen p-6 relative text-gray-700">
        <div>
            <div class="text-3xl text-indigo-900">{{ $post->title }}</div>
            <div class="mt-8 text-xl text-indigo-400">{{ $post->excerpt }}</div>
            <x-icon-larabiz class="absolute bottom-8 left-1/2 -translate-x-1/2 h-6" />
        </div>
    </body>
</html>
