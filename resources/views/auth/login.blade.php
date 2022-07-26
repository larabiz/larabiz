<x-app>
    <div class="container md:grid md:grid-cols-2 py-8 md:py-16 md:max-w-[1024px]">
        <div class="md:col-span-1 md:pr-8">
            <h2 class="font-extrabold leading-tight text-center text-xl">
                Connexion
            </h2>

            <x-form method="POST" action="{{ route('login') }}" class="grid gap-4 mt-6">
                <input type="hidden" name="remember" value="1" />

                <div class="grid">
                    <label for="email" class="font-bold">E-mail</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="homer@simpson.com" required class="bg-white/75 focus:bg-white border-0 placeholder-indigo-200/75 mt-1 px-4 py-3 rounded shadow shadow-indigo-100 transition-colors w-full" />
                    <x-error name="email" />
                </div>

                <div class="grid">
                    <label for="password" class="font-bold">Mot de passe</label>
                    <input type="password" id="password" name="password" required class="bg-white/75 focus:bg-white border-0 mt-1 placeholder-indigo-200/75 px-4 py-3 rounded shadow shadow-indigo-100 transition-colors w-full" />
                    <x-error name="password" />
                </div>

                <x-cta type="submit" class="mt-4">Connexion</x-cta>
            </x-form>
        </div>

        <div class="border-t md:border-t-0 md:border-l border-indigo-100 md:col-span-1 grid place-items-center mt-10 md:mt-0 md:pl-8 pt-8 md:pt-0">
            <div>
                <h2 class="font-extrabold leading-tight text-center text-xl">
                    Pas encore inscrit ?
                </h2>

                <p class="mt-2 text-center text-lg">Créer un compte sur {{ config('app.name') }}, c'est <strong class="bg-green-200/50">facile</strong>, <strong class="bg-purple-200/50">rapide</strong> et <strong class="bg-indigo-200/50">gratuit</strong> !</p>

                <a href="{{ route('register') }}" class="bg-gradient-to-r from-indigo-300 to-indigo-400 font-bold mx-auto mt-8 px-8 py-3 rounded shadow-lg shadow-indigo-200 table text-indigo-50 text-sm xs:text-base hover:text-white">
                    Créer un compte
                </a>
            </div>
        </div>
    </div>
</x-app>
