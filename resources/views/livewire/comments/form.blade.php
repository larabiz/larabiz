<div class="mt-8 sm:mt-16 xs:mx-auto xs:max-w-screen-xs">
    <x-forms.form
        method="POST"
        id="comments-form"
        class="grid gap-8 mt-2"
        @submit.prevent="$wire.storeComment(); window.fathom?.trackGoal('6YTIFBO7', 0)"
    >
        <div>
            <x-forms.textarea
                id="content"
                wire:model="content"
                placeholder="Votre commentaire"
                tabindex="0"
            >{{ old('content') }}</x-forms.textarea>

            <span class="block text-center text-indigo-300 text-xs">
                La syntaxe Markdown est supportée.
            </span>
        </div>

        <div class="-mt-4" x-data="{ subscribe: @js($this->subscribed) }">
            <input type="hidden" wire:model="subscribe" :value="subscribe" />

            <x-forms.toggle :toggled="$this->subscribed">
                Suivre l'activité de l'article
                <span class="block text-indigo-300 text-xs">Il est possible de vous désabonner à tout moment.</span>
            </x-forms.toggle>
        </div>

        <x-buttons.cta type="submit">
            Commenter
        </x-buttons.cta>
    </x-forms.form>
</div>
