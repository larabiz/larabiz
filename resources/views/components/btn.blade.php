@if ($attributes->has('href'))
    <a {{ $attributes->merge(['class' => 'font-bold inline-block px-8 py-3 rounded text-sm xs:text-base transition active:scale-[.98]']) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'button', 'class' => 'font-bold inline-block px-8 py-3 rounded text-sm xs:text-base transition active:scale-[.98]']) }}>
        {{ $slot }}
    </button>
@endif
