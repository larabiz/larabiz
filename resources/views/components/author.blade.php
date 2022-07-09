<aside class="border-t border-indigo-100 flex items-start gap-4 py-8">
    <img loading="lazy" src="https://www.gravatar.com/avatar/{{ md5($author->email) }}?s=144" alt="Avatar de {{ $author->name }}." width="48" height="48" class="rounded-full">

    <div>
        <div class="font-bold">{{ $author->name }}</div>

        <div class="!max-w-none leading-normal prose prose-a:bg-indigo-100 prose-a:font-bold prose-a:no-underline prose-a:text-indigo-400 prose-pre:p-0">
            {{ $author->biography }}
        </div>
    </div>
</aside>
