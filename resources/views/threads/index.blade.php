@php
$title = $q
    ? "Discussions correspondant à \"$q\""
    : 'Forum';
@endphp
<x-app :title="$title">
    <x-breadcrumb class="container max-w-[1024px] mt-8 sm:mt-16">
        <x-breadcrumb-item>Forum</x-breadcrumb-item>
    </x-breadcrumb>

    <div class="container grid sm:grid-cols-3 gap-4 md:gap-8 max-w-[1024px] py-8 sm:py-16">
        <div class="sm:order-2">
            <x-action-btn href="{{ route('threads.create') }}" class="text-center w-full">
                Nouvelle discussion
            </x-action-btn>

            <nav class="mt-4 md:mt-8 text-sm">
                <ul class="grid gap-1">
                    <li>
                        <a href="{{ route('threads.index') }}" class="flex items-center gap-2 px-4 py-3 rounded-md @if (! $filter_by) bg-indigo-100 font-bold text-indigo-400 @endif">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-translate-y-[1px] w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" /></svg>

                            Toutes les discussions
                        </a>
                    </li>

                    @auth
                        <li>
                            <a href="{{ route('threads.index', ['filter_by' => 'my_threads']) }}" class="flex items-center gap-2 px-4 py-3 rounded-md @if ($filter_by === 'my_threads') bg-indigo-100 font-bold text-indigo-400 @endif">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-translate-y-[.5px] w-4 h-4"> <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /> </svg>

                                Mes discussions
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('threads.index', ['filter_by' => 'contributed']) }}" class="flex items-center gap-2 px-4 py-3 rounded-md @if ($filter_by === 'contributed') bg-indigo-100 font-bold text-indigo-400 @endif">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-translate-y-[.5px] w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" /></svg>

                                Mes contributions
                            </a>
                        </li>
                    @endauth

                    <li>
                        <a href="{{ route('threads.index', ['filter_by' => 'resolved']) }}" class="flex items-center gap-2 px-4 py-3 rounded-md @if ($filter_by === 'resolved') bg-indigo-100 font-bold text-indigo-400 @endif">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-translate-y-[.5px] w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>

                            Résolues
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('threads.index', ['filter_by' => 'unresolved']) }}" class="flex items-center gap-2 px-4 py-3 rounded-md @if ($filter_by === 'unresolved') bg-indigo-100 font-bold text-indigo-400 @endif">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-translate-y-[.5px] w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>

                            Non-résolues
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('threads.index', ['filter_by' => 'no_reply']) }}" class="flex items-center gap-2 px-4 py-3 rounded-md @if ($filter_by === 'no_reply') bg-indigo-100 font-bold text-indigo-400 @endif">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-translate-y-[.5px] w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.182 16.318A4.486 4.486 0 0012.016 15a4.486 4.486 0 00-3.198 1.318M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" /></svg>

                            Sans réponses
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="sm:col-span-2 sm:order-1">
            <x-form method="GET" :action="route('threads.index')">
                <label for="q" class="sr-only">Rechercher</label>
                <x-search-field placeholder="relation polymorphic, etc." :value="$q" />
            </x-form>

            <div class="grid gap-4 mt-4 md:mt-8">
                @foreach ($threads as $thread)
                    <x-thread :thread="$thread" />
                @endforeach
            </div>

            {{ $threads->links() }}
        </div>
    </div>
</x-app>
