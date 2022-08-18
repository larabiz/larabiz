<x-layout.app
    title="Matériel, logiciels et services utilisés pour Larabiz"
    description="La création et la maintenance d'un site requiert des outils divers et variés de toutes sortes."
>
    <article class="container py-8 sm:py-16">
        <h1 class="font-extrabold leading-tight mb-6 text-center text-2xl md:text-3xl">
            Quel matériel, logiciels et services pour faire du développement Laravel ?
        </h1>

        <div class="flex flex-wrap sm:flex-nowrap items-center justify-center sm:justify-start gap-8">
            <div class="order-2 sm:order-none">
                <h2 class="font-extrabold text-lg sm:text-xl">DigitalOcean</h2>

                <p class="mt-2">DigitalOcean est un service moderne fourissant des VPS (Virtual Private Servers ou serveurs virtuels privés) redimensionnables à des prix aussi dérisoirs que <strong class="font-bold">~4€/mois</strong>. Personnellement, je me fiche qu'un produit soit français ou pas. Tout ce que je veux, c'est être satisfait. Et j'apprécie le fait qu'il fonctionne sans effort avec Laravel Forge.</p>

                <p class="mt-4">Vous pouvez vous y mettre également en <a href="https://m.do.co/c/58bbdf89fc72" class="font-semibold text-indigo-400">cliquant ici</a> (lien affilié).</p>
            </div>

            <x-icon-digitalocean class="fill-current flex-shrink-0 order-1 sm:order-none h-40 text-[#0080ff]" />
        </div>

        <div class="flex flex-wrap sm:flex-nowrap items-center justify-center sm:justify-start gap-8 mt-16">
            <x-icon-fathom class="flex-shrink-0 h-10" />

            <div>
                <h2 class="font-extrabold text-lg sm:text-xl">Fathom Analytics</h2>

                <p class="mt-2">Le respect de la vie privée des utilisateurs de Larabiz est pour moi une priorité. Par conséquent, utiliser un outil tel que Google Analytics n'est pas une option. Fathom Analytics en revanche répond à ce besoin. C'est un outil simple d'utilisation qui fait exactement ce qu'on lui demande pour un prix raisonnable.</p>

                <p class="mt-4">Soutenez Larabiz en <a href="https://usefathom.com/ref/JTPOCN" class="font-semibold text-indigo-400">essayant Fathom Analytics gratuitement</a>.</p>
            </div>
        </div>

        <div class="border-t border-indigo-100 mt-8 pt-8" x-intersect="window.fathom?.trackGoal('BBCFCNA5', 0)">
            <p>Pour le reste, voici une liste non-exhaustive :</p>

            <ul class="list-disc ml-4 mt-2 pl-4">
                <li class="mt-2">
                    <a href="https://1password.com/fr/" target="_blank" rel="nofollow noopener" class="font-semibold text-indigo-400" @click="window.fathom?.trackGoal('CDYFQCYN', 0)">
                        1Password
                    </a>
                </li>

                <li class="mt-2">
                    <a href="https://ia.net/writer" target="_blank" rel="nofollow noopener" class="font-semibold text-indigo-400" @click="window.fathom?.trackGoal('CDYFQCYN', 0)">
                        IA Writer
                    </a>
                </li>

                <li class="mt-2">
                    <a href="https://www.apple.com/fr/iphone-13-pro/" target="_blank" rel="nofollow noopener" class="font-semibold text-indigo-400" @click="window.fathom?.trackGoal('CDYFQCYN', 0)">
                        iPhone 13 Pro Max
                    </a>
                </li>

                <li class="mt-2">
                    <a href="https://forge.laravel.com" target="_blank" rel="nofollow noopener" class="font-semibold text-indigo-400" @click="window.fathom?.trackGoal('CDYFQCYN', 0)">
                        Laravel Forge
                    </a>
                </li>

                <li class="mt-2">
                    <a href="https://www.apple.com/fr/shop/buy-mac/macbook-pro/14-pouces" target="_blank" rel="nofollow noopener" class="font-semibold text-indigo-400" @click="window.fathom?.trackGoal('CDYFQCYN', 0)">
                        MacBook Pro 14" M1 Pro et 16 Go de RAM
                    </a>
                </li>

                <li class="mt-2">
                    <a href="https://paw.cloud" target="_blank" rel="nofollow noopener" class="font-semibold text-indigo-400" @click="window.fathom?.trackGoal('CDYFQCYN', 0)">
                        Paw
                    </a>
                </li>

                <li class="mt-2">
                    <a href="https://www.sketch.com" target="_blank" rel="nofollow noopener" class="font-semibold text-indigo-400" @click="window.fathom?.trackGoal('CDYFQCYN', 0)">
                        Sketch
                    </a>
                </li>

                <li class="mt-2">
                    <a href="https://tableplus.com" target="_blank" rel="nofollow noopener" class="font-semibold text-indigo-400" @click="window.fathom?.trackGoal('CDYFQCYN', 0)">
                        TablePlus
                    </a>
                </li>

                <li class="mt-2">
                    <a href="https://tinkerwell.app" target="_blank" rel="nofollow noopener" class="font-semibold text-indigo-400" @click="window.fathom?.trackGoal('CDYFQCYN', 0)">
                        Tinkerwell
                    </a>
                </li>

                <li class="mt-2">
                    <a href="https://www.git-tower.com/mac" target="_blank" rel="nofollow noopener" class="font-semibold text-indigo-400" @click="window.fathom?.trackGoal('CDYFQCYN', 0)">
                        Tower
                    </a>
                </li>

                <li class="mt-2">
                    <a href="https://code.visualstudio.com" target="_blank" rel="nofollow noopener" class="font-semibold text-indigo-400" @click="window.fathom?.trackGoal('CDYFQCYN', 0)">
                        Visual Studio Code
                    </a>
                </li>
            </ul>
        </div>
    </article>
</x-app>
