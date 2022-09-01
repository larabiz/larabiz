<div {{ $attributes->merge(['class' => 'mt-8 sm:mt-16 xs:mx-auto xs:max-w-screen-xs']) }}>
    <x-form
        method="POST"
        action="{{ route('threads.store') }}"
        id="comments-form"
        class="grid gap-8 mt-2"
    >
        <div>
            <x-label for="title">Titre</x-label>
            <x-input id="title" name="title" placeholder="Titre de votre discussion" />
        </div>

        <div>
            <x-label for="title">Contenu</x-label>

            <x-textarea
                id="content"
                name="content"
                placeholder="Contenu de votre discussion"
                required
                tabindex="0"
                class="min-h-[200px]"
            >{{ old('content') }}</x-textarea>

            <span class="block text-center text-indigo-300 text-xs">
                La syntaxe Markdown est supportée.
            </span>
        </div>

        <x-action-btn type="submit">
            Créer
        </x-action-btn>
    </x-form>
</div>
