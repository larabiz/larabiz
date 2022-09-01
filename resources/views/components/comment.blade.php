<div class="bg-gradient-to-b from-white to-gray-50 px-4 py-6 sm:p-6 rounded-lg shadow shadow-indigo-100">
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
                        <x-heroicon-o-trash class="text-red-400 translate-y-[-1px] w-4 h-4" />
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
