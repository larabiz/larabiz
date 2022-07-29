<x-app title="Il n'y a pas que Larabiz dans la vie">
    <x-section>
        <x-slot:title>
            Il n'y a pas que Larabiz dans la vie
        </x-slot>

        <div class="-mt-2">
            Lorsqu'on est développeur, il est très important d'aller chercher l'information peu importe où elle se trouve. Vos sources doivent être diversifiées et {{ config('app.name') }} vous aide à en trouver de nouvelles.
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 sm:gap-8 mt-8">
            <a href="https://laravel.cm" target="_blank" rel="noopener noreferrer" class="border border-indigo-100 p-4 rounded text-center" @click="window.fathom?.trackGoal('U4RBWUT3', 0)">
                <x-icon-laravel-cm class="h-16 inline" />
                <span class="block font-bold mt-4 text-sm sm:text-base">Laravel Cameroun</span>
            </a>

            <a href="https://laravel-france.com" target="_blank" rel="noopener noreferrer" class="border border-indigo-100 p-4 rounded text-center" @click="window.fathom?.trackGoal('U4RBWUT3', 0)">
                <img src="{{ secure_asset('img/laravel-france.png') }}" alt="Laravel France" class="h-16 inline" />
                <span class="block font-bold mt-4 text-sm sm:text-base">Laravel France</span>
            </a>

            <a href="https://nordcoders.fr" target="_blank" rel="noopener noreferrer" class="border border-indigo-100 p-4 rounded text-center" @click="window.fathom?.trackGoal('U4RBWUT3', 0)">
                <img src="{{ secure_asset('img/nordcoders.png') }}" alt="Nord Coders" class="h-16 inline" />
                <span class="block font-bold mt-4 text-sm sm:text-base">Nord Coders</span>
            </a>

            <a href="https://www.tutomarks.fr" target="_blank" rel="noopener noreferrer" class="border border-indigo-100 p-4 rounded text-center" @click="window.fathom?.trackGoal('U4RBWUT3', 0)">
                <img src="{{ secure_asset('img/tutomarks.png') }}" alt="Nord Coders" class="h-16 inline" />
                <span class="block font-bold mt-4 text-sm sm:text-base">Tutomarks</span>
            </a>
        </div>
    </x-section>
</x-app>
