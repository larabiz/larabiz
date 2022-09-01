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
                            <x-heroicon-o-bars-4 class="-translate-y-[1px] h-4" />
                            Toutes les discussions
                        </a>
                    </li>

                    @auth
                        <li>
                            <a href="{{ route('threads.index', ['filter_by' => 'my_threads']) }}" class="flex items-center gap-2 px-4 py-3 rounded-md @if ($filter_by === 'my_threads') bg-indigo-100 font-bold text-indigo-400 @endif">
                                <x-heroicon-o-user class="-translate-y-[.5px] h-4" />
                                Mes discussions
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('threads.index', ['filter_by' => 'contributed']) }}" class="flex items-center gap-2 px-4 py-3 rounded-md @if ($filter_by === 'contributed') bg-indigo-100 font-bold text-indigo-400 @endif">
                                <x-heroicon-o-chat-bubble-left-right class="-translate-y-[.5px] h-4" />
                                Mes contributions
                            </a>
                        </li>
                    @endauth

                    <li>
                        <a href="{{ route('threads.index', ['filter_by' => 'resolved']) }}" class="flex items-center gap-2 px-4 py-3 rounded-md @if ($filter_by === 'resolved') bg-indigo-100 font-bold text-indigo-400 @endif">
                            <x-heroicon-o-check-circle class="-translate-y-[.5px] h-4" />
                            Résolues
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('threads.index', ['filter_by' => 'unresolved']) }}" class="flex items-center gap-2 px-4 py-3 rounded-md @if ($filter_by === 'unresolved') bg-indigo-100 font-bold text-indigo-400 @endif">
                            <x-heroicon-o-x-circle class="-translate-y-[.5px] h-4" />
                            Non-résolues
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('threads.index', ['filter_by' => 'no_reply']) }}" class="flex items-center gap-2 px-4 py-3 rounded-md @if ($filter_by === 'no_reply') bg-indigo-100 font-bold text-indigo-400 @endif">
                            <x-heroicon-o-face-frown class="-translate-y-[.5px] h-4" />
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
