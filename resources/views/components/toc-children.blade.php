@if (count($children))
    <ul class="ml-4">
        @foreach ($children as $child)
            <li class="mt-1">
                <a
                    href="#{{ str($child['title'])->slug }}"
                    class="flex items-center gap-2 font-normal text-indigo-400"
                    @click="open = false"
                >
                    <x-icon-circle class="fill-current flex-shrink-0 text-indigo-200 w-[5px] h-[5px] -translate-y-[.5px]" />
                    {{ $child['title'] }}
                </a>

                <x-toc-children :children="$child['children']" />
            </li>
        @endforeach
    </ul>
@endif
