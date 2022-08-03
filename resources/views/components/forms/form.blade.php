<form method="{{ $method === 'GET' ? $method : 'POST' }}" {{ $attributes->except(['method']) }}>
    @csrf

    @if ('POST' !== $method)
        @method($method)
    @endif

    {{ $slot }}
</form>
