<div @if (empty($this->frameless)) class="bg-gradient-to-b from-white to-gray-50 rounded-lg shadow shadow-indigo-100" @endif>
    @if ($comment->comment)
        <div class="border-b border-gray-100 p-4 text-center text-gray-400 text-sm">
            En réponse au <a href="{{ route('posts.comments.show', $comment->comment) }}" class="font-semibold text-indigo-300">commentaire</a> de <span class="font-semibold">{{ $comment->comment->user->username }}</span>
        </div>
    @endif

    <div class="@if (empty($this->frameless)) px-4 py-6 sm:p-6 @endif">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <img loading="lazy" src="https://www.gravatar.com/avatar/{{ md5($comment->user->email) }}?s=144" width="40" height="40" class="flex-shrink-0 rounded-full translate-y-[-1px]" />

                <div class="text-sm">
                    <div class="font-bold">{{ $comment->user->username }}</div>

                    @if (empty($this->frameless))
                        <div>
                            <a href="{{ route('posts.comments.show', $comment) }}" class="text-blue-300">
                                {{ $comment->created_at->diffForHumans() }}
                            </a>
                        </div>
                    @else
                        <div class="text-blue-400">
                            {{ $comment->created_at->diffForHumans() }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="flex items-center justify-end gap-4">
                @can('delete', $comment)
                    <button
                        class="border flex items-center justify-center rounded-full transition-colors @if (empty($this->frameless)) border-red-100 hover:bg-red-100 w-8 h-8 @else border-indigo-100 hover:bg-indigo-100 w-10 h-10 @endif"
                        @click="if (window.confirm('Souhaitez-vous vraiment supprimer ce commentaire ?')) $wire.removeComment({{ $this->frameless }})"
                    >
                        <x-heroicon-o-trash class="text-red-400 translate-y-[-1px] @if (empty($this->frameless)) w-4 h-4 @else w-5 h-5 @endif" />
                    </button>
                @endcan

                @if (auth()->check() && auth()->user()?->isNot($comment->user))
                    <button
                        class="border border-indigo-100 hover:bg-indigo-100 flex items-center justify-center rounded-full transition-colors @if (empty($this->frameless)) w-8 h-8 @else w-10 h-10 @endif"
                        @click="$wire.emit('comment.address_reply_to', '{{ $comment->random_id }}'); $refs.content.focus()"
                    >
                        <x-heroicon-o-reply class="text-indigo-400 translate-y-[-1px] @if (empty($this->frameless)) w-4 h-4 @else w-5 h-5 @endif" />
                    </button>
                @endif
            </div>
        </div>

        <div class="break-words mt-4 sm:mt-6 prose prose-a:bg-indigo-100/75 prose-a:font-semibold prose-a:no-underline prose-a:text-indigo-400 prose-blockquote:border-indigo-100 prose-blockquote:font-serif prose-blockquote:text-indigo-900/75 prose-img:my-0 prose-img:max-h-[50vh] prose-li:my-0 prose-pre:whitespace-pre-wrap prose-strong:font-bold !max-w-none @if (! empty($this->frameless)) bg-gradient-to-b from-white to-gray-50 p-4 sm:p-6 rounded-lg shadow shadow-indigo-100 @endif">
            {!! Illuminate\Support\Str::lightdown($comment->content) !!}
        </div>
    </div>
</div>
