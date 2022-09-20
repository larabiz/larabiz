<input type="{{ $type ?? 'text' }}" {{ $attributes->merge(['class' => 'bg-white/75 focus:bg-white border-0 placeholder-indigo-200/75 mt-1 px-4 py-3 rounded shadow shadow-indigo-100 transition-colors w-full']) }} />

@if (empty($errorDisabled))
    <x-error :name="$name" :bag="$bag ?? 'default'"  />
@endif
