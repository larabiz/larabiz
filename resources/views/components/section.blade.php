<section {{ $attributes->merge(['class' => 'container py-16']) }}>
    @if (! empty($header))
        <header class="mb-6">{{ $header }}</header>
    @elseif(! empty($title))
        <header class="mb-8">
            <{{ $title->attributes->get('tag', 'h1') }} {{ $title->attributes->merge(['class' => 'font-extrabold leading-tight text-center text-xl']) }}>
                {{ $title }}
            </{{ $title->attributes->get('tag', 'h1') }}>
        </header>
    @endif

    {{ $slot }}
</section>
