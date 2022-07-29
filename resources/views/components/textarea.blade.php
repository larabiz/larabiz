<x-error :name="$name ?? $id" :bag="$bag ?? 'default'" class="!mt-0 mb-2" />

<textarea
    {{ $attributes->merge(['class' => 'bg-white/75 focus:bg-white border-0 mt-1 placeholder-indigo-200/75 px-4 py-3 resize-none rounded shadow shadow-indigo-100 transition-colors w-full']) }}
    @if (empty($disableAutoResizing))
        x-data="{
            resize: () => {
                $el.style.height = '5px'
                $el.style.height = $el.scrollHeight + 'px'
            }
        }"
        x-init="resize()"
        @input="resize()"
    @endif
>{{ $slot }}</textarea>
