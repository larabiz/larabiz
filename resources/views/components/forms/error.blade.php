@error($name, $bag ?? 'default')
    <span {{ $attributes->merge(['class' => 'bg-red-400 dark:bg-red-900/50 font-semibold inline-block gap-0 mt-2 px-4 py-3 rounded text-center sm:text-left text-red-50 dark:text-red-200 text-sm']) }}>
        {{ $message }}
    </span>
@enderror
