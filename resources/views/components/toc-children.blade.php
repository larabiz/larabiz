@if (count($children))
    <ul class="list-disc ml-4 pl-4">
        @foreach ($children as $child)
            <li>
                <a
                    href="#{{ str($child['title'])->slug }}"
                    class="text-indigo-200 md:text-indigo-400"
                    @click="open = false"
                >
                    {{ $child['title'] }}
                </a>

                <x-toc-children :children="$child['children']" />
            </li>
        @endforeach
    </ul>
@endif
