<div {{ $attributes->merge(['class' => 'bg-white/75 relative rounded shadow shadow-indigo-100 transition-colors']) }} :class="{ 'bg-white': focused }" x-data="{ focused: false }">
    <input
        type="search"
        id="q"
        name="q"
        value="{{ $value ?? old('search') }}"
        placeholder="{{ $placeholder ?? 'Rechercher' }}"
        autocomplete="off"
        required
        class="bg-transparent border-0 placeholder-indigo-200/75 pl-12 pr-20 py-3 rounded w-full"
        x-ref="searchField"
        @blur="focused = false"
        @focus="focused = true"
        @keydown.cmd.k.window="$refs.searchField.focus()"
        @keydown.ctrl.k.window="$refs.searchField.focus()"
    />

    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute top-1/2 left-4 text-indigo-200/75 w-4 h-4 -translate-y-1/2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>

    <div class="absolute top-1/2 right-2 border border-indigo-100 cursor-default px-2 py-1 rounded-sm text-indigo-200/75 text-xs -translate-y-1/2">
        Ctrl/⌘K
    </div>
</div>
