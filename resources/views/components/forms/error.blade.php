@error($name, $bag ?? 'default')
    <span {{ $attributes->merge(['class' => 'bg-red-400 font-semibold inline-block gap-0 mt-2 px-4 py-3 rounded text-center sm:text-left text-red-50 text-sm']) }}>
        {{ $message }}
    </span>
@enderror
