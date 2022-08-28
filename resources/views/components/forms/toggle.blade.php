<div class="bg-indigo-200/20 rounded shadow shadow-indigo-100 flex items-center px-4 py-3" x-data="{ toggled: @js($toggled) }">
    <span class="cursor-default flex-grow" @click="toggled = ! toggled">{{ $slot }}</span>

    <button
        type="button"
        role="switch"
        tabindex="0"
        :aria-checked="toggled"
        :class="{ 'bg-indigo-400': toggled, 'bg-indigo-200': ! toggled }"
        class="relative inline-flex flex-shrink-0 h-[21px] w-[34px] border-2 border-transparent rounded-full cursor-pointer transition-colors
        ease-in-out duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
        @click="toggled = ! toggled; $emit('toggled', toggled)"
    >
        <span class="sr-only">
            {{ $slot }}
        </span>

        <span
            aria-hidden="true"
            :class="{ 'translate-x-[.8rem]': toggled }"
            class="pointer-events-none inline-block h-[17px] w-[17px] rounded-full bg-white shadow shadow-indigo-900/10 transform ring-0 transition ease-in-out duration-200"
        ></span>
    </button>
</div>
