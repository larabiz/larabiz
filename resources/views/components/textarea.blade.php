<textarea
    {{ $attributes->merge(['class' => 'bg-white/75 focus:bg-white border-0 mt-1 placeholder-indigo-200/75 px-4 py-3 resize-none rounded shadow shadow-indigo-100 transition-colors w-full']) }}
    x-data="{ resize: () => { $el.style.height = '5px'; $el.style.height = $el.scrollHeight + 'px' } }"
    x-init="resize()"
    @input="resize()"
>{{ $slot }}</textarea>

<x-error :name="$name" :bag="$bag ?? 'default'"  />
