<div class="mt-8 sm:mt-16 xs:mx-auto xs:max-w-screen-xs">
    {{-- Form --}}
    <x-form
        method="POST"
        action="{{ route('posts.comments.store', $post) }}"
        id="comments-form"
        class="grid gap-8 mt-2"
    >
        {{-- Textarea --}}
        <div>
            <x-textarea
                id="content"
                name="content"
                placeholder="Votre commentaire"
                required
                tabindex="0"
            >{{ old('content') }}</x-textarea>

            {{-- Tip about Markdown --}}
            <span class="block text-center text-indigo-300 text-xs">
                La syntaxe Markdown est supportée.
            </span>
        </div>

        <label class="-mt-4 bg-indigo-200/20 flex items-center gap-4 px-4 py-3 rounded-md">
            <input
                type="checkbox"
                name="subscribe"
                value="1"
                @checked($subscribed)
                class="border-0 rounded shadow shadow-indigo-100 text-indigo-400"
            />

            <span>
                Notifiez-moi pour chaque nouveau commentaire
                <span class="block text-indigo-300 text-xs">Il est possible de vous désabonner à tout moment.</span>
            </span>
        </label>

        {{-- Submit button --}}
        <x-action-btn type="submit">
            Commenter
        </x-action-btn>
    </x-form>
</div>
