@if ($name = $name ?? $id ?? null)
    <x-forms.error :name="$name" :bag="$bag ?? 'default'" class="!mt-0 mb-2" />
@endif

<textarea
    {{ $attributes->merge(['class' => 'bg-white/75 focus:bg-white border-0 placeholder-indigo-200/75 px-4 py-3 resize-none rounded shadow shadow-indigo-100 transition-colors w-full']) }}
    x-init="$el.style.height = '5px'; $el.style.height = `${$el.scrollHeight}px`"
    @input="$el.style.height = '5px'; $el.style.height = `${$el.scrollHeight}px`"
>{{ $slot }}</textarea>
