<div id="comment-{{ $comment->id }}" class="bg-gradient-to-b from-white to-gray-50 px-4 py-6 sm:p-6 rounded-lg shadow shadow-indigo-100">
    {{-- Comment's header --}}
    <div class="flex items-center justify-between">
        {{-- Comment's author and date --}}
        <div class="flex items-center gap-4">
            <img loading="lazy" src="https://www.gravatar.com/avatar/{{ md5($comment->user_email) }}?s=144" width="40" height="40" class="flex-shrink-0 rounded-full translate-y-[-1px]" />

            <div class="text-sm">
                <div class="font-bold">
                    {{ $comment->username }}
                </div>

                <div class="text-blue-300">
                    {{ $comment->created_at->diffForHumans() }}
                </div>
            </div>
        </div>

        {{-- Comment's actions --}}
        <div class="flex items-center justify-end gap-4">
            @can('delete', $comment)
                <x-form method="DELETE" action="{{ route('comments.destroy', $comment) }}">
                    <button
                        type="submit"
                        class="border border-red-100 hover:bg-red-100 flex items-center justify-center rounded-full transition-colors w-8 h-8"
                    >
                        <span class="sr-only">Supprimer</span>

                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-red-400 translate-y-[-1px] w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                    </button>
                </x-form>
            @endcan
        </div>
    </div>

    {{-- Comment's content --}}
    <div class="break-words mt-4 sm:mt-6 prose prose-a:bg-indigo-100/75 prose-a:font-semibold prose-a:no-underline prose-a:text-indigo-400 prose-blockquote:border-indigo-100 prose-blockquote:font-serif prose-blockquote:text-indigo-900/75 prose-img:my-0 prose-img:max-h-[50vh] prose-li:my-0 prose-pre:whitespace-pre-wrap prose-strong:font-bold !max-w-none">
        {!! Illuminate\Support\Str::lightdown($comment->content) !!}
    </div>
</div>
