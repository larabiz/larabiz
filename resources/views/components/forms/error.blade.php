@error($name, $bag ?? 'default')
    <span {{ $attributes->merge(['class' => 'font-semibold inline-block mt-2 text-red-400 text-sm']) }}>
        {{ $message }}
    </span>
@enderror
