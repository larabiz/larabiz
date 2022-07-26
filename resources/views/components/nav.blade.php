<nav {{ $attributes->merge(['class' => 'container flex items-center justify-between gap-8 sm:gap-0 pt-4 relative text-sm sm:text-base']) }}>
    <a href="{{ route('home') }}">
        <x-icon-larabiz class="h-6 sm:h-7" />
    </a>

    <ul class="flex items-center gap-6 sm:gap-8 justify-start">
        <li>
            <a href="{{ route('home') }}" class="font-semibold @if (Route::is('home')) text-indigo-400 @else hover:text-indigo-400 transition-colors @endif">
                <span class="sr-only">Accueil</span>
                <x-heroicon-o-home class="w-5 h-5 -translate-y-[0.5px]" />
            </a>
        </li>

        <li>
            <a href="{{ route('posts.index') }}" class="font-semibold  @if (Route::is('posts.index') || Route::is('posts.show')) text-indigo-400 @else hover:text-indigo-400 transition-colors @endif">
                <span class="sr-only sm:not-sr-only">Blog</span>
                <x-heroicon-o-newspaper class="sm:sr-only w-5 h-5 -translate-y-[0.5px]" />
            </a>
        </li>

        @auth
            <li class="sm:relative -m-2" x-data="{ open: false }" @click.away="open = false">
                <button class="block relative font-semibold p-2 rounded-full" x-bind:class="{ 'bg-white/75': open }" @click="open = ! open">
                    <x-heroicon-o-bell class="w-5 h-5 -translate-y-[0.5px]" />
                    @if ($count = auth()->user()->unreadNotifications()->count())
                        <span class="w-2 h-2 rounded-full bg-red-400 absolute top-2 right-2"></span>
                    @endif
                </button>

                <x-notifications :count="$count" x-show="open" />
            </li>

            <li class="relative" x-data="{ open: false }" @click.away="open = false">
                <button class="flex items-center gap-2 font-semibold" @click="open = ! open">
                    <img loading="lazy" src="https://www.gravatar.com/avatar/{{ md5(auth()->user()->email) }}?s=144" width="28" height="28" class="rounded-full" /> <x-heroicon-o-chevron-down class="h-4 transition" x-bind:class="{ 'rotate-180': open }" />
                </button>

                <div class="absolute top-full right-0 backdrop-blur-md bg-white/75 min-w-[200px] mt-2 py-2 rounded-lg shadow-xl shadow-indigo-900/10 z-10" x-show="open" x-transition>
                    <a href="{{ route('user.profile') }}" class="hover:bg-indigo-400 flex items-center gap-2 font-semibold px-4 py-2 hover:text-white transition-colors">
                        <x-heroicon-o-user class="h-4 translate-y-[-0.5px]" />
                        Mon profil
                    </a>

                    <div class="bg-indigo-50 h-px my-2"></div>

                    @if (auth()->user()->email === 'benjamincrozat@me.com')
                        <a href="{{ url(config('nova.path')) }}" target="_blank" class="hover:bg-purple-400 flex items-center gap-2 font-semibold px-4 py-2 hover:text-white transition-colors">
                            <x-icon-nova class="fill-current h-4 translate-y-[-0.5px]" />
                            Nova
                        </a>

                        <a href="{{ url(config('horizon.path')) }}" target="_blank" class="hover:bg-purple-400 flex items-center gap-2 font-semibold px-4 py-2 hover:text-white transition-colors">
                            <x-icon-horizon class="h-4 translate-y-[-0.5px]" />
                            Horizon
                        </a>

                        <div class="bg-indigo-50 h-px my-2"></div>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="hover:bg-red-400 flex items-center gap-2 font-semibold px-4 py-2 text-left text-red-400 hover:text-white transition-colors w-full">
                            <x-heroicon-s-logout class="h-4 translate-y-[-0.5px]" />
                            Déconnexion
                        </button>
                    </form>
                </div>
            </li>
        @else
            <li>
                <a href="{{ route('login') }}" class="font-semibold @if (Route::is('login')) text-indigo-400 @else hover:text-indigo-400 transition-colors @endif">
                    <span class="sr-only sm:not-sr-only">Connexion</span>
                    <x-heroicon-s-login class="sm:sr-only w-5 h-5 -translate-y-[0.5px]" />
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
