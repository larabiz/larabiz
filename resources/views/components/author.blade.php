<aside {{ $attributes->merge(['class' => 'flex items-start gap-4']) }}>
    <img
        loading="lazy"
        src="https://www.gravatar.com/avatar/{{ md5($email) }}?s=144"
        width="48"
        height="48"
        class="rounded-full"
    />

    <div>
        <p class="font-bold">
            {{ $username }}
        </p>

        <div
            class="!max-w-none leading-normal prose prose-a:bg-indigo-100
            prose-a:font-bold prose-a:no-underline prose-a:text-indigo-400 prose-pre:p-0 text-indigo-400"
        >
            {!! Illuminate\Support\Str::markdown($biography) !!}
        </div>
    </div>
</aside>
