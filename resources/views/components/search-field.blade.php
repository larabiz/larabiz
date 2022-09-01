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

    <x-heroicon-o-magnifying-glass class="absolute top-1/2 left-4 text-indigo-200/75 w-4 h-4 -translate-y-1/2" />

    <div class="absolute top-1/2 right-2 border border-indigo-100 cursor-default px-2 py-1 rounded-sm text-indigo-200/75 text-xs -translate-y-1/2">
        Ctrl/⌘K
    </div>
</div>
