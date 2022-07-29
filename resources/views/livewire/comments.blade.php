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
        @if (! $user?->hasVerifiedEmail())
            <div class="mt-8 sm:mt-16 text-center text-indigo-900/75 text-lg sm:text-xl">
                Vous y êtes presque.<br />
                Il n'y a plus qu'à confirmer votre adresse e-mail.
            </div>
        @elseif ($user?->hasVerifiedEmail())
            <div class="xs:max-w-screen-xs mt-8 sm:mt-16 xs:mx-auto">
                @if ($this->commentRepliedToRandomId)
                    <div class="bg-indigo-100 flex items-center justify-between gap-4 font-semibold mb-2 px-4 py-3 rounded">
                        <div>
                            En réponse à {{ $this->comment->user->username }}
                        </div>

                        <button wire:click="$set('commentRepliedToRandomId', null)" class="text-indigo-400">
                            Annuler
                        </button>
                    </div>
                @endif

                <x-form
                    method="POST"
                    id="comments-form"
                    class="grid gap-8"
                    wire:submit.prevent="storeComment"
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

                    <x-cta type="submit" @click="window.fathom?.trackGoal('6YTIFBO7', 0)">Commenter</x-cta>
                </x-form>
            </div>
        @endif
    @else
        <div class="mt-8 sm:mt-16 text-center text-indigo-900/75 text-lg sm:text-xl">
            Besoin d'aide&nbsp;? Envie de partager&nbsp;?<br />
            <a href="{{ route('register') }}" class="font-semibold text-indigo-400">Inscrivez-vous</a> ou <a href="{{ route('login') }}" class="font-semibold text-indigo-400">connectez-vous</a> d'abord.
        </div>
    @endif
</div>
