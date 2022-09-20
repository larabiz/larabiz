<nav {{ $attributes->merge(['class' => 'container flex items-center justify-between gap-8 sm:gap-0 pt-6 sm:pt-4 relative text-sm sm:text-base']) }}>
    <a href="{{ route('home') }}">
        <x-icon-larabiz class="h-6 md:h-7 hidden sm:inline" />
        <x-icon-larabiz-icon class="h-6 sm:hidden" />
    </a>

    <ul class="flex items-center gap-6 sm:gap-8 justify-start">
        <li>
            <a href="{{ route('posts.index') }}" class="font-semibold @if (Route::is('posts.index') || Route::is('posts.show')) text-indigo-400 @else hover:text-indigo-400 transition-colors @endif">
                <span class="sr-only sm:not-sr-only">Blog</span>

                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:sr-only w-5 h-5 -translate-y-[0.5px]"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" /></svg>
            </a>
        </li>

        <li class="relative">
            <a
                @if (app()->isProduction()) href="#" @else href="{{ route('threads.index') }}" @endif
                class="font-semibold @if (Route::is('threads.index') || Route::is('threads.show')) text-indigo-400 @else hover:text-indigo-400 transition-colors @endif"
                @if (app()->isProduction()) @click.prevent="alert('Bientôt !')" @endif
            >
                <span class="sr-only sm:not-sr-only">Forum</span>

                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:sr-only w-5 h-5 -translate-y-[0.5px]"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" /></svg>
            </a>

            <span class="absolute -top-6 sm:-top-4 left-1/2 sm:left-auto sm:-right-8 bg-yellow-400 font-semibold leading-normal mt-1 rounded-full text-center text-xs w-[65px] -translate-x-1/2 sm:translate-x-0 scale-75">
                Bientôt !
            </span>
        </li>

        <li class="relative">
            <a
                href="https://twitter.com/Larabiz_"
                target="_blank"
                rel="noopener noreferrer"
                class="font-semibold text-blue-400"
            >
                <span class="sr-only">Twitter</span>
                <x-icon-twitter-alt class="fill-current w-5 h-5 -translate-y-[0.5px]" />
            </a>
        </li>

        @auth
            <li><livewire:notifications.listing /></li>

            <li class="relative" x-data="{ open: false }" @click.away="open = false">
                <button class="flex items-center gap-2 font-semibold" @click="open = ! open; if (open) window.fathom?.trackGoal('1JKTOPRB', 0)">
                    <img loading="lazy" src="https://www.gravatar.com/avatar/{{ md5($user->email) }}?s=144" width="28" height="28" class="rounded-full" />

                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 transition" x-bind:class="{ 'rotate-180': open }"> <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /> </svg>

                    <span class="sr-only">
                        {{ $user->username }}
                    </span>
                </button>

                <div class="absolute top-full right-0 backdrop-blur-md bg-white/75 min-w-[200px] mt-2 py-2 rounded-lg shadow-xl shadow-indigo-900/10 z-10" x-show="open" x-transition>
                    <div class="font-bold leading-tight px-4 py-2">
                        {{ $user->username }}
                    </div>

                    <div class="bg-indigo-900/5 h-px my-2"></div>

                    <a href="{{ route('user-profile') }}" class="hover:bg-indigo-400 flex items-center gap-2 font-semibold px-4 py-2 hover:text-white transition-colors">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 translate-y-[-0.5px]"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>

                        Mes informations
                    </a>

                    <a href="{{ route('user-password') }}" class="hover:bg-indigo-400 flex items-center gap-2 font-semibold px-4 py-2 hover:text-white transition-colors">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 translate-y-[-0.5px]"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>

                        Mon mot de passe
                    </a>

                    <a href="{{ route('user-subscriptions') }}" class="hover:bg-indigo-400 flex items-center gap-2 font-semibold px-4 py-2 hover:text-white transition-colors">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 translate-y-[-0.5px]"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" /></svg>

                        Mes notifications
                    </a>

                    <div class="bg-indigo-900/5 h-px my-2"></div>

                    @if ($user->email === config('app.master_email'))
                        <a href="{{ url(config('horizon.path')) }}" class="hover:bg-purple-400 flex items-center gap-2 font-semibold px-4 py-2 hover:text-white transition-colors">
                            <x-icon-horizon class="h-4 translate-y-[-0.5px]" />
                            Horizon
                        </a>

                        <div class="bg-indigo-900/5 h-px my-2"></div>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-honeypot />

                        <button
                            type="submit"
                            class="hover:bg-red-400 flex items-center gap-2 font-semibold px-4 py-2 text-left text-red-400 hover:text-white transition-colors w-full"
                            @click="window.fathom?.trackGoal('KETMVOZT', 0)"
                        >
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 translate-y-[-0.5px]"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" /></svg>

                            Déconnexion
                        </button>
                    </form>
                </div>
            </li>
        @else
            <li>
                <a href="{{ route('login') }}" class="font-semibold @if (Route::is('login')) text-indigo-400 @else hover:text-indigo-400 transition-colors @endif">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:sr-only w-5 h-5 -translate-y-[0.5px]"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" /></svg>

                    <span class="sr-only sm:not-sr-only">Connexion</span>
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
