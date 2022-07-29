<div>
    <h2 class="font-extrabold leading-tight mb-8 sm:mb-16 text-center text-xl">
        @choice(':count commentaire|:count commentaires', $this->post->comments()->count())
    </h2>

    @if ($this->hasComments)
        <div class="grid gap-4">
            @foreach ($this->comments as $comment)
                <livewire:comment :comment="$comment" wire:key="comment-{{ $comment->id }}" />
            @endforeach
        </div>

        {{ $this->comments->links() }}
    @endif

    @auth
        <div class="xs:max-w-screen-xs mt-8 sm:mt-16 xs:mx-auto">
            @if ($this->comment_random_id)
                <div class="bg-indigo-100 flex items-center justify-between gap-4 font-semibold mb-2 px-4 py-3 rounded">
                    <div>
                        En réponse à {{ $this->comment->user->username }}
                    </div>

                    <button wire:click="$set('comment_random_id', null)" class="text-indigo-400">
                        Annuler
                    </button>
                </div>
            @endif

            <x-form
                method="POST"
                action="{{ route('posts.comments.store', $this->post) }}"
                id="comments-form"
                class="grid gap-8"
                @submit.prevent="$wire.storeComment(); document.getElementById('comments').scrollIntoView({ behavior: 'smooth' })"
            ><div>
                    <x-label for="content" class="sr-only">Votre commentaire</x-label>

                    <x-textarea
                        id="content"
                        wire:model="content"
                        placeholder="Votre commentaire"
                        tabindex="0"
                        class="min-h-[200px]"
                        x-ref="content"
                        :disable-auto-resizing="true"
                    >{{ old('content') }}</x-textarea>

                    <span class="block text-indigo-300 text-xs">La syntaxe Markdown est supportée.</span>
                </div>

                <x-cta type="submit">Commenter</x-cta>
            </x-form>
        </div>
    @else
        <div class="mt-8 sm:mt-16 text-center text-indigo-900/75 text-lg sm:text-xl">
            Besoin d'aide ? Envie de partager ?<br />
            <a href="{{ route('register') }}" class="font-semibold text-indigo-400">Inscrivez-vous</a> ou <a href="{{ route('login') }}" class="font-semibold text-indigo-400">connectez-vous</a> d'abord.
        </div>
    @endauth
</div>
