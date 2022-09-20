<ul class="border-b border-indigo-50 flex items-center gap-1 p-1">
    <li>
        <button
            title="Titre"
            class="hover:bg-indigo-50 font-mono flex items-center justify-center w-8 h-8 rounded transition-colors"
            @click.prevent="title"
        >
            H
        </button>
    </li>

    <li>
        <button
            title="Gras (⌘B)"
            class="hover:bg-indigo-50 font-bold font-mono flex items-center justify-center w-8 h-8 rounded transition-colors"
            @click.prevent="bold"
        >
            B
        </button>
    </li>

    <li>
        <button
            title="Italique (⌘I)"
            class="hover:bg-indigo-50 italic font-mono flex items-center justify-center w-8 h-8 rounded transition-colors"
            @click.prevent="italic"
        >
            I
        </button>
    </li>

    <li>
        <button
            title="Souligner (⌘U)"
            class="hover:bg-indigo-50 underline font-mono flex items-center justify-center w-8 h-8 rounded transition-colors"
            @click.prevent="underline"
        >
            U
        </button>
    </li>

    <li>
        <button
            title="Blockquote (⌘⇧.)"
            class="hover:bg-indigo-50 underline font-mono flex items-center justify-center w-8 h-8 rounded transition-colors"
            @click.prevent="blockquote"
        >
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
        </button>
    </li>

    <li>
        <button
            title="Code (⌘E)"
            class="hover:bg-indigo-50 underline font-mono flex items-center justify-center w-8 h-8 rounded transition-colors"
            @click.prevent="code"
        >
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5" /></svg>

            <span class="sr-only">Code</span>
        </button>
    </li>

    <li>
        <button
            title="Lien (⌘J)"
            class="hover:bg-indigo-50 underline font-mono flex items-center justify-center w-8 h-8 rounded transition-colors"
            @click.prevent="link"
        >
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" /></svg>

            <span class="sr-only">Lien</span>
        </button>
    </li>

    <li>
        <button
            title="Liste (⌘7)"
            class="hover:bg-indigo-50 underline font-mono flex items-center justify-center w-8 h-8 rounded transition-colors"
            @click.prevent="list"
        >
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>

            <span class="sr-only">Liste</span>
        </button>
    </li>
</ul>

<textarea
    {{ $attributes }}
    tabindex="0"
    class="bg-transparent focus:bg-white border-0 min-h-[200px] px-4 py-3 placeholder-indigo-200/75 resize-none focus:ring-0 transition-colors w-full"
    x-init="$el.style.height = '5px'; $el.style.height = `${$el.scrollHeight}px`"
    x-ref="markdown"
    @blur="focused = false"
    @focus="focused = true"
    @input="$el.style.height = '5px'; $el.style.height = `${$el.scrollHeight}px`"
    @resize.window="$el.style.height = '5px'; $el.style.height = `${$el.scrollHeight}px`"
    @keydown.meta.b.prevent.stop="bold"
    @keydown.meta.i.prevent.stop="italic"
    @keydown.meta.u.prevent.stop="underline"
    @keydown.meta.s.prevent.stop="strikethrough"
    @keydown.meta.shift.period.prevent.stop="blockquote"
    @keydown.meta.e.prevent.stop="code"
    @keydown.meta.j.prevent.stop="link"
    @keydown.meta.7.prevent.stop="list"
>{{ $slot }}</textarea>

<script>
    function title() {
        const { start, end, substring } = getSelection.call(this)

        if (substring.search(/###/) === -1) {
            var newString = `### ${substring}`

            this.$refs.markdown.value = this.$refs.markdown.value.replace(substring, newString)
        } else {
            var newString = substring.replace(/### ?/g, '')

            this.$refs.markdown.value = this.$refs.markdown.value.replace(substring, newString)
        }

        select.call(this, start, newString.length)
    }

    function bold() {
        const { start, end, substring } = getSelection.call(this)

        if (substring.search(/\*\*/) === -1) {
            var newString = `**${substring}**`

            this.$refs.markdown.value = this.$refs.markdown.value.replace(substring, newString)
        } else {
            var newString = substring.replace(/\*\*/g, '')

            this.$refs.markdown.value = this.$refs.markdown.value.replace(substring, newString)
        }

        select.call(this, start, newString.length)
    }

    function italic() {
        const { start, end, substring } = getSelection.call(this)

        if (substring.search(/\*/) === -1) {
            var newString = `*${substring}*`

            this.$refs.markdown.value = this.$refs.markdown.value.replace(substring, newString)
        } else {
            var newString = substring.replace(/\*/g, '')

            this.$refs.markdown.value = this.$refs.markdown.value.replace(substring, newString)
        }

        select.call(this, start, newString.length)
    }

    function underline() {
        const { start, end, substring } = getSelection.call(this)

        if (substring.search(/_/) === -1) {
            var newString = `_${substring}_`

            this.$refs.markdown.value = this.$refs.markdown.value.replace(substring, newString)
        } else {
            var newString = substring.replace(/_/g, '')

            this.$refs.markdown.value = this.$refs.markdown.value.replace(substring, newString)
        }

        select.call(this, start, newString.length)
    }

    function blockquote() {
        const { start, end, substring } = getSelection.call(this)

        if (substring.search(/>(.*)/) === -1) {
            var newString = substring.split(/\s*[\r|\n]\s*?/).map(i => `> ${i}`).join(`\n`)

            this.$refs.markdown.value = this.$refs.markdown.value.replace(substring, newString)
        } else {
            var newString = substring.replace(/> ?(.*)/g, '$1')

            this.$refs.markdown.value = this.$refs.markdown.value.replace(substring, newString)
        }

        select.call(this, start, newString.length)
    }

    function code() {
        const { start, end, substring } = getSelection.call(this)

        if (substring.split(/\r\n|\r|\n/).length > 1) {
            if (substring.search(/\`\`\`(.*)?[\r|\n].*[\r|\n]\`\`\`/) === -1) {
                var newString = `\`\`\`\n${substring}\n\`\`\``

                this.$refs.markdown.value = this.$refs.markdown.value.replace(substring, newString)
            } else {
                var newString = substring.replace(/\`\`\`(.*)?[\r|\n](.*)[\r|\n]\`\`\`/g, '$2')

                this.$refs.markdown.value = this.$refs.markdown.value.replace(substring, newString)
            }
        } else {
            if (substring.search(/\`(.*)\`/) === -1) {
                var newString = `\`${substring}\``

                this.$refs.markdown.value = this.$refs.markdown.value.replace(substring, newString)
            } else {
                var newString = substring.replace(/\`(.*)\`/g, '$1')

                this.$refs.markdown.value = this.$refs.markdown.value.replace(substring, newString)
            }
        }

        select.call(this, start, newString.length)
    }

    function link() {
        const { start, end, substring } = getSelection.call(this)

        if (substring.search(/\[.*\]\(.*\)/) === -1) {
            var newString = `[${substring}](url)`

            this.$refs.markdown.value = this.$refs.markdown.value.replace(substring, newString)
        } else {
            var newString = substring.replace(/\[(.*)\]\((.*)\)/, '$1')

            this.$refs.markdown.value = this.$refs.markdown.value.replace(substring, newString)
        }

        select.call(this, start + newString.length - 4, 3)
    }

    function list() {
        const { start, end, substring } = getSelection.call(this)

        if (substring.search(/-(.*)/) === -1) {
            var newString = substring.split(/\s*[\r|\n]\s*?/).map(i => `- ${i}`).join(`\n`)

            this.$refs.markdown.value = this.$refs.markdown.value.replace(substring, newString)
        } else {
            var newString = substring.replace(/- ?(.*)/g, '$1')

            this.$refs.markdown.value = this.$refs.markdown.value.replace(substring, newString)
        }

        select.call(this, start, newString.length)
    }

    function getSelection() {
        const start = this.$refs.markdown.selectionStart
        const end = this.$refs.markdown.selectionEnd

        return {
            start,
            end,
            substring: this.$refs.markdown.value.substring(start, end),
        }
    }

    function select(start, length) {
        this.$refs.markdown.setSelectionRange(start, start + length)
        this.$refs.markdown.focus()
    }
</script>
