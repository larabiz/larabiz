@if ($attributes->has('href'))
    <a
        {{ $attributes->merge(['class' => 'font-bold inline-block px-8
        py-3 rounded text-sm xs:text-base transition-colors']) }}
    >
        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->merge(['type' => 'button', 'class' => 'font-bold inline-block
        px-8 py-3 rounded text-sm xs:text-base transition-colors']) }}
    >
        {{ $slot }}
    </button>
@endif
