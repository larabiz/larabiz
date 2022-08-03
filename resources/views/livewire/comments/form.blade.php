<div
    class="mt-8 sm:mt-16 xs:mx-auto xs:max-w-screen-xs"
    x-data="{ previewIsActive: false }"
>
    <div class="grid grid-cols-2 bg-gradient-to-b from-gray-900 to-gray-700 font-bold rounded text-sm text-white/80">
        <button
            class="px-4 py-2 rounded"
            :class="{ 'bg-gradient-to-r from-gray-400 to-gray-600 shadow-md shadow-indigo-900/10 text-white': ! previewIsActive }"
            @click="previewIsActive = false"
        >
            Mon commentaire
        </button>

        <button
            class="px-4 py-2 rounded"
            :class="{ 'bg-gradient-to-r from-gray-400 to-gray-600 shadow-md shadow-indigo-900/10 text-white': previewIsActive }"
            @click="previewIsActive = true"
        >
            Aperçu
        </button>
    </div>

    <x-forms.form
        method="POST"
        id="comments-form"
        class="grid gap-8 mt-2"
        x-show="! previewIsActive"
        @submit.prevent="$wire.storeComment(); window.fathom?.trackGoal('6YTIFBO7', 0)"
    >
        <div>
            <x-forms.textarea
                id="content"
                wire:model="content"
                placeholder="Votre commentaire"
                tabindex="0"
            >{{ old('content') }}</x-forms.textarea>

            <span class="block text-indigo-300 text-xs">
                La syntaxe Markdown est supportée.
            </span>
        </div>

        <x-buttons.cta type="submit">
            Commenter
        </x-buttons.cta>
    </x-forms.form>

    <div
        class="!max-w-none border border-indigo-100 mt-2 px-4 py-3 prose prose-a:bg-indigo-100/75 prose-a:font-semibold prose-a:no-underline prose-a:text-indigo-400 prose-blockquote:border-indigo-100 prose-blockquote:font-serif prose-blockquote:text-indigo-900/75 prose-img:my-0 prose-img:max-h-[50vh] prose-li:my-0 prose-pre:whitespace-pre-wrap prose-strong:font-bold rounded"
        x-show="previewIsActive"
    >
        {!! Illuminate\Support\Str::lightdown($this->content) !!}
    </div>
</div>
