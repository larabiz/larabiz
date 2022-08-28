<nav {{ $attributes->merge(['class' => 'container flex items-center justify-between gap-8 sm:gap-0 pt-6 sm:pt-4 relative text-sm sm:text-base']) }}>
    <a href="{{ route('home') }}">
        <x-icon-larabiz class="h-6 md:h-7 hidden sm:inline" />
        <x-icon-larabiz-icon class="h-6 sm:hidden" />
    </a>

    <ul class="flex items-center gap-6 sm:gap-8 justify-start">
        <li>
            <a href="{{ route('posts.index') }}" class="font-semibold @if (Route::is('posts.index') || Route::is('posts.show')) text-indigo-400 @else hover:text-indigo-400 transition-colors @endif">
                <span class="sr-only sm:not-sr-only">Blog</span>
                <x-heroicon-o-newspaper class="sm:sr-only w-5 h-5 -translate-y-[0.5px]" />
            </a>
        </li>

        <li class="relative">
            <a
                href="#"
                class="font-semibold"
                @click.prevent="window.fathom?.trackGoal('OCXHSBNK', 0); alert('Il n\'y a rien à voir pour le moment. Mais les commentaires sur le blog sont opérationnels et n\'attendent que vous !')"
            >
                <span class="sr-only sm:not-sr-only">Discussions</span>
                <x-heroicon-o-chat-bubble-left-right class="sm:sr-only w-5 h-5 -translate-y-[0.5px]" />
            </a>

            <span class="absolute -top-6 sm:-top-4 left-1/2 sm:left-auto sm:-right-4 bg-yellow-400 font-semibold leading-normal mt-1 rounded-full text-center text-xs w-[55px] -translate-x-1/2 sm:translate-x-0 scale-75">
                Bientôt
            </span>
        </li>

        <li class="relative">
            <a
                href="https://twitter.com/Larabiz_"
                target="_blank"
                rel="noopener noreferrer"
                class="font-semibold hover:text-blue-400 transition-colors"
            >
                <span class="sr-only">Twitter</span>
                <x-icon-twitter-alt class="fill-current w-5 h-5 -translate-y-[0.5px]" />
            </a>
        </li>

        @auth
            <li>
                <livewire:notifications.listing />
            </li>

            <li class="relative" x-data="{ open: false }" @click.away="open = false">
                <button class="flex items-center gap-2 font-semibold" @click="open = ! open; if (open) window.fathom?.trackGoal('1JKTOPRB', 0)">
                    <img loading="lazy" src="https://www.gravatar.com/avatar/{{ md5($user->email) }}?s=144" width="28" height="28" class="rounded-full" /> <x-heroicon-o-chevron-down class="h-4 transition" x-bind:class="{ 'rotate-180': open }" />
                </button>

                <div class="absolute top-full right-0 backdrop-blur-md bg-white/75 min-w-[200px] mt-2 py-2 rounded-lg shadow-xl shadow-indigo-900/10 z-10" x-show="open" x-transition>
                    <div class="font-bold leading-tight px-4 py-2">
                        {{ $user->username }}
                    </div>

                    <div class="bg-indigo-900/5 h-px my-2"></div>

                    <a href="{{ route('user-profile') }}" class="hover:bg-indigo-400 flex items-center gap-2 font-semibold px-4 py-2 hover:text-white transition-colors">
                        <x-heroicon-o-user class="h-4 translate-y-[-0.5px]" />
                        Mon profil
                    </a>

                    <div class="bg-indigo-900/5 h-px my-2"></div>

                    @if ($user->email === 'benjamincrozat@me.com')
                        <a href="{{ url(config('nova.path')) }}" class="hover:bg-purple-400 flex items-center gap-2 font-semibold px-4 py-2 hover:text-white transition-colors">
                            <x-icon-nova class="fill-current h-4 translate-y-[-0.5px]" />
                            Nova
                        </a>

                        <a href="{{ url(config('horizon.path')) }}" class="hover:bg-purple-400 flex items-center gap-2 font-semibold px-4 py-2 hover:text-white transition-colors">
                            <x-icon-horizon class="h-4 translate-y-[-0.5px]" />
                            Horizon
                        </a>

                        <div class="bg-indigo-900/5 h-px my-2"></div>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            type="submit"
                            class="hover:bg-red-400 flex items-center gap-2 font-semibold px-4 py-2 text-left text-red-400 hover:text-white transition-colors w-full"
                            @click="window.fathom?.trackGoal('KETMVOZT', 0)"
                        >
                            <x-heroicon-s-arrow-left-on-rectangle class="h-4 translate-y-[-0.5px]" />
                            Déconnexion
                        </button>
                    </form>
                </div>
            </li>
        @else
            <li>
                <a href="{{ route('login') }}" class="font-semibold @if (Route::is('login')) text-indigo-400 @else hover:text-indigo-400 transition-colors @endif">
                    <span class="sr-only sm:not-sr-only">Connexion</span>
                    <x-heroicon-s-arrow-right-on-rectangle class="sm:sr-only w-5 h-5 -translate-y-[0.5px]" />
                </a>
            </li>

            <li>
                <a href="{{ route('register') }}" class="font-semibold @if (Route::is('register')) text-indigo-400 @else hover:text-indigo-400 transition-colors @endif">
                    Inscription
                </a>
            </li>
        @endauth
    </ul>
</nav>
