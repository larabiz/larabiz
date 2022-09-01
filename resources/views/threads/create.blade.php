<x-app>
    <x-breadcrumb class="container mt-8 sm:mt-16">
        <x-breadcrumb-item link="{{ route('threads.index') }}">Forum</x-breadcrumb-item>
        <x-breadcrumb-item>Nouvelle discussion</x-breadcrumb-item>
    </x-breadcrumb>

    <x-section>
        <x-slot:title>
            Nouvelle discussion
        </x-slot:title>

        <div class="mt-8 sm:mt-16">
            <x-form
                method="POST"
                action="{{ route('threads.store') }}"
                id="comments-form"
                class="grid gap-8 mt-2"
            >
                <div>
                    <x-label for="title">Titre</x-label>
                    <x-input id="title" name="title" placeholder="CSRF token mismatch" />
                </div>

                <div x-data="{ focused: false }">
                    <x-label for="title">Contenu</x-label>

                    <x-error name="content" class="!mt-0 mb-2" />

                    <div class="bg-white/75 mt-1 rounded shadow shadow-indigo-100 transition-colors" :class="{ 'bg-white': focused }">
                        <x-markdown
                            id="content"
                            name="content"
                            placeholder="Bonjour, voici mon problème…"
                            required
                        >{{ old('content') }}</x-markdown>

                        <div class="pb-4 px-4 text-right">
                            <x-action-btn type="submit" class="shadow-md w-full">
                                Créer
                            </x-action-btn>
                        </div>
                    </div>

                    <div class="mt-2 text-center text-indigo-300 text-xs">
                        La syntaxe Markdown est supportée.
                    </div>
                </div>
            </x-form>
        </div>
    </x-section>
</x-app>
