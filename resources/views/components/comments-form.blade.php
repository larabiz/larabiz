<div class="mt-8 sm:mt-16">
    {{-- Form --}}
    <x-form
        method="POST"
        action="{{ route('posts.comments.store', $post) }}"
        id="comments-form"
        class="grid gap-8 mt-2"
        x-data="{ focused: false }"
    >
        {{-- Textarea --}}
        <div class="bg-white/75 mt-1 rounded shadow shadow-indigo-100 transition-colors" :class="{ 'bg-white': focused }">
            <x-markdown
                id="content"
                name="content"
                placeholder="Votre commentaire"
                required
            >{{ old('content') }}</x-markdown>
        </div>

        <label class="-mt-4 bg-indigo-200/20 flex items-center gap-4 p-4 rounded-md">
            <input
                type="checkbox"
                name="subscribe"
                value="1"
                @checked($subscribed)
                class="border-0 rounded shadow shadow-indigo-100 text-indigo-400"
            />

            <span class="leading-tight">
                <span>Notifiez-moi pour chaque nouveau commentaire</span>
                <span class="block mt-1 text-indigo-300 text-xs">Il est possible de vous désabonner à tout moment.</span>
            </span>
        </label>

        {{-- Submit button --}}
        <x-action-btn type="submit">
            Commenter
        </x-action-btn>
    </x-form>
</div>
