<nav {{ $attributes }}>
    <ol class="container flex items-center gap-2 sm:gap-3 font-normal">
        <x-breadcrumb-item link="{{ route('home') }}">
            {{ config('app.name') }}
        </x-breadcrumb-item>

        {{ $slot }}
    </ol>
</nav>
