<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    public function run() : void
    {
        $post = Post::create([
            'user_id' => 1,
            'title' => '4 astuces pour un code propre et solide sur le long terme',
            'slug' => 'astuces-tutoriel-code-propre-laravel',
            'excerpt' => 'Pouvoir revenir sur un projet après des mois sans y avoir touché est un avantage. Découvrez quelques astuces pour ne plus être totalement perdu.',
            'content' => <<<'EOT'
*Il est tellement facile de laisser un projet moisir au fond du tiroir une fois qu'il est déployé en production.*

*Mais un beau jour, votre client finira par revenir vers vous. Il voudra faire évoluer son projet. Malheureusement, votre code est devenu incompréhensible et il est devenu très simple de provoquer des régressions. C'est normal, rares sont ceux qui possèdent une mémoire infaillible. La livraison devient un enfer et vous n'avez qu'une seule envie : faire subir à votre client les pires châtiments imaginables.*

*Attention cependant : ce n'est pas la faute de votre client si la situation a échappé à votre contrôle.*

*Voyons ensemble ce que vous pouvez faire dès maintenant pour changer ça.*

### Utilisez des packages open source

Croyez-en mon expérience : utiliser du code testé et éprouvé par la communauté donnera presque toujours de bien meilleurs résultats que ce que vous aurez vous-même pondu. Pourquoi ?

- Un package open source est développé par une multitude de personnes très intelligentes ;
- Il est testé et éprouvé par la communauté. Selon la popularité du package, le nombre d'individus se chiffre en dizaines de milliers ;
- Enfin, il est documenté. Et ne me dites pas que vous documenterez votre code plus tard ! Vous aurez la flemme, comme presque tout le monde, et ce seront vos remplaçants qui en pâtiront.

Alors à partir de maintenant, faites donc ça. Je vous garanti que cela paiera très vite.

<figure>
  <img src="https://larabiz.fr/storage/13/conversions/f335fff99ef05af6c0203d52809af2f91433be0a-large.jpg" alt="Capture d'écran de tous les contributeurs de Laravel.">
  <figcaption>Parfois, mieux vaut écrire son code soi-même. Mais la plupart du temps, je préfère que mes arrières soient surveillées par toutes ces personnes.</figcaption>
</figure>

### Formatez automatiquement votre code

OK. Le premier qui n'applique pas ce conseil sera exilé sur une île déserte sans connexion à internet.

Personnellement, j'utilise un outil appelé [PHP CS Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer), couplé à Visual Studio Code via [cette extension](https://github.com/junstyle/vscode-php-cs-fixer).

Installez PHP CS Fixer globalement avec Composer :

```bash
composer global require friendsofphp/php-cs-fixer
```

Ensuite, créez votre fichier de configuration ([servez-vous du mien ici](https://gist.github.com/benjamincrozat/35388133c82b674209fe917c71f03377) si vous le souhaitez) que vous mettrez à la racine de votre projet.

<figure>
  <img src="https://larabiz.fr/storage/14/conversions/3136a520b9cb3c8da985c0d7623dc6ec59458796-large.jpg" alt="Capture d'écran du fichier .php-cs-fixer.php">
</figure>

Si l'extension est bien configurée, alors votre code sera formaté à chaque fois que vous sauvegarderez votre document.

L'avantage d'avoir fait tout ça ? Vos collaborateurs aussi pourront en profiter.

### Commentez votre code

Haha ! Je vous vois déjà arriver :

> Tant que ton code est bien écrit, il n'y a pas besoin de le commenter !

Et bien non ! Comme tout dans cet univers, ça dépend. Alors attention, Il vaut mieux ne pas commenter son code si c'est pour faire ce genre d'infamie :

```php
// Create user.
User::factory()->create();
```

**Ce commentaire ne sert à rien**. C'est de la décoration. Et j'avoue m'être rendu coupable de ça un nombre de fois incalculable dans ma carrière.

Prenons plutôt un bon exemple tout droit sorti de la codebase de Larabiz :

```php
Subscriber::create($input)->notify(new ConfirmSubscription);
```

Ça coule de source, non ? Ce code n'a absolument pas besoin d'être commenté.

Maintenant, prenons du code issu d'un autre de mes projets :

```php
// Create an incomplete purchase (meaning there's no start and end dates until the payment succeeded).
$purchase = Purchase::factory()->incomplete()->create([
    'opening_id' => $this->opening->id,
    'boost_id' => $this->boost->id,
]);

// Let's pretend Stripe called our web hook.
$job = new BoostOpening(new WebhookCall(['payload' => ['data' => ['object' => ['id' => $purchase->checkout_session_id]]]]));
$job->handle();

// After the job did its job (🥁), the purchase should
// have a start date that equals to right now().
$this->assertEquals(
    now()->toDateTimeString(),
    ($purchase = $purchase->fresh())->starts_at
);

// … and an end date which equals to now + the boost's duration in days.
$this->assertEquals(
    now()->addDays(\$this->boost->days)->toDateTimeString(),
    $purchase->ends_at
);

// Then, the opening should detect it's been boosted.
$this->assertEquals(1, $this->opening->purchases()->count());
```

Il s'agit d'un test automatisé. Il est très compliqué de rendre lisible ce genre de code. Dans le cas présent, le mieux est de communiquer ses intentions. Et croyez-moi, remettre les mains dans une codebase commentée après <del>quelques mois</del> <ins>semaines</ins> sans y avoir touché, c'est un véritable bonheur.

### Respectez les conventions de Laravel

*Sortir des sentiers battus est une excellente chose* et je vous encourage vivement à le faire. Mais comme je l'ai dit plus haut, tout dépend du contexte.  
Ici, le mieux est de coller au maximum avec ce que vous préconise Laravel. Ne chamboulez pas sa [structure](https://laravel.com/docs/structure) et **utilisez au maximum** toutes les fonctionnalités qu'il vous offre. Ainsi, vous pourrez :

1. Faciliter la collaboration avec les développeurs qui connaissent Laravel aussi bien que vous ; (Eh oui, car vous aurez à nouveau la flemme de documenter tous les trucs farfelus que vous aurez inventés !)
2. Bénéficier d'améliorations en même temps que le framework évolue.

![Logo de Laravel.](https://larabiz.fr/storage/15/conversions/2974c234a1e6132cb86f8ec71370de5645463db8-large.jpg)

### Conclusion

Il y a encore bien plus que vous pourriez faire pour faciliter votre vie de développeur, ainsi que celle de vos collègues. Mais nous verrons cela une prochaine fois. Le but de cet article était de vous donner des conseils facilement applicables à vos projets.

À bientôt ! 👋
EOT,
            'certified_for_laravel' => 9,
            'created_at' => '2022-02-03 21:36:18',
        ]);

        $post
            ->addMediaFromUrl('https://larabiz.fr/storage/ZjfzeaNKpYWkZpl3VBeeYUzAXHIbXemFHnnWADUk.jpg')
            ->toMediaCollection('illustration');

        $post
            ->addMediaFromUrl('https://larabiz.fr/storage/13/f335fff99ef05af6c0203d52809af2f91433be0a.jpg')
            ->toMediaCollection('images');

        $post
            ->addMediaFromUrl('https://larabiz.fr/storage/14/3136a520b9cb3c8da985c0d7623dc6ec59458796.jpg')
            ->toMediaCollection('images');

        $post
            ->addMediaFromUrl('https://larabiz.fr/storage/15/2974c234a1e6132cb86f8ec71370de5645463db8.jpg')
            ->toMediaCollection('images');

        $post = Post::create([
            'user_id' => 1,
            'title' => 'Comment créer une page avec Laravel',
            'slug' => 'comment-creer-page-laravel',
            'excerpt' => "Afin de créer une page sur Laravel, il nous faut comprendre les bases du système de routing. Nous allons voir à quel point c'est extrêmement simple.",
            'content' => <<<'EOT'
Prenons une installation propre de Laravel :

```bash
laravel new mon-super-site && cd mon-super-site
```

Ouvrez le projet dans votre éditeur favori et ajoutez ceci à la fin du fichier `routes/web.php` :

```php
Route::get('/ma-super-page', function () {
    return 'Bienvenu sur ma super page !';
});
```

Et voilà ! C'est un tel plaisir de constater de l'avancement lorsqu'on se forme sur une technologie.

![Capture d'écran de notre nouvelle page.](https://larabiz.fr/storage/5/conversions/eefc2ff24d1653b863dc68866c4c42550263b545-large.jpg)

Bien sûr, ce n'est pas en faisant des pages de cette qualité que vous arrivez à lancer le projet de vos rêves.  
Il est tout à fait possible d'écrire le HTML requis pour créer une vraie page web dans le callback, mais je pense que nous serons tous d'accord pour dire que c'est une solution abominable.

Créeons plutôt une vue :

```bash
touch resources/views/ma-super-page.blade.php
```

Dans ce fichier fraichement créé, ajoutez le HTML suivant :

```blade
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">

        <title>Ma Super Page</title>

        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        <div class="flex items-center justify-center min-h-screen">
            <h1 class="font-thin text-5xl">Ma Super Page</h1>
        </div>
    </body>
</html>
```

Enfin, changez la déclaration de la route avec celle-ci :

```php
Route::view('/ma-super-page', 'ma-super-page');
```

Actualisez votre page et admirez le résultat. 🤙

![Capture d'écran de notre page avec un minimum de CSS.](https://larabiz.fr/storage/6/conversions/fa1e490dded4d1de1c4ebf218299b0e827943db3-large.jpg)

Maintenant que votre page est créée, pourquoi ne pas [apprendre à créer des formulaires](https://larabiz.fr/blog/comment-creer-formulaire-laravel) ? Il vous faudra aussi les styliser et j'ai écrit deux articles à propos de l'[intégration de Tailwind CSS](https://larabiz.fr/blog/comment-tailwind-css-3-laravel) et [Bootstrap](https://larabiz.fr/blog/comment-bootstrap-5-laravel) dans un projet Laravel.

Bonne chance dans votre apprentissage et à bientôt sur Larabiz. 👋
EOT,
            'certified_for_laravel' => 9,
            'created_at' => '2022-02-03 21:40:51',
        ]);

        $post
            ->addMediaFromUrl('https://larabiz.fr/storage/w2txfZFXQ0Dvraig533tB64R3CBwX2eevvVVHDLy.jpg')
            ->toMediaCollection('illustration');

        $post
            ->addMediaFromUrl('https://larabiz.fr/storage/5/conversions/eefc2ff24d1653b863dc68866c4c42550263b545-large.jpg')
            ->toMediaCollection('images');

        $post
            ->addMediaFromUrl('https://larabiz.fr/storage/6/conversions/fa1e490dded4d1de1c4ebf218299b0e827943db3-large.jpg')
            ->toMediaCollection('images');

        $post = Post::create([
            'user_id' => 1,
            'title' => 'Comment créer un nouveau projet avec Laravel',
            'slug' => 'comment-creer-nouveau-projet-laravel',
            'excerpt' => "Saviez-vous qu'il y a un installeur officiel Laravel ? Ou qu'il est possible de passer tout un tas d'options lors de la création d'un nouveau projet ?",
            'content' => <<<'EOT'
## Créer un nouveau projet Laravel simple

Rien de compliqué pour cette première commande. Elle crée un nouveau projet basé sur la dernière version de Laravel. En fait, il s'agit de l'équivalent de la commande `composer create-project laravel/laravel mon-super-site`.

```bash
laravel new mon-super-site
```

Un nouveau dossier est créé, le dépôt *laravel/laravel* cloné, les dépendances PHP installées et un *.env* créé avec une clé de chiffrage fraiche.

## Créer un nouveau projet Laravel avec un dépôt Git initialisé

Les choses deviennent encore plus intéressantes à partir de là. De nos jours, il est suicidaire de commencer un nouveau projet sans le versionner avec Git. Heureusement, l'installeur Laravel est là pour nous épauler.

```bash
laravel new mon-super-site --git
```

Entrez dans le dossier fraichement créé et vérifiez que le dépôt a bien été initialisé avec la commande `git log` :

```
commit af00c6d789c5278495ee797dc6dd9556af9a7f2d (HEAD -> main)
Author: Benjamin Crozat <hello@benjamincrozat.com>
Date:   Tue Feb 1 18:16:50 2022 +0100

Set up a fresh Laravel app
```

## Créer un nouveau projet Laravel avec un dépôt Git initialisé et poussé sur GitHub

Celle-ci, c'est ma préférée. Il faudra d'abord installer le [CLI officiel de GitHub](https://github.com/cli/cli#installation) par contre.  
Une fois installé et authentifié, exécutez la commande suivante :

```bash
laravel new mon-super-site --github
```

Cela créera un dépôt Git privé en un clin d'œil. Si vous avez l'habitude de démarrer 10 projets par semaine, vous apprécierez sûrement le gain de temps.

## Créer un nouveau projet basé sur Laravel Jetstream

[Laravel Jetstream](https://jetstream.laravel.com) est un kit de démarrage taillé pour ceux qui ont besoin de lancer un projet vite et bien. Pas de temps à perdre sur le choix du stack technique, des design patterns à mettre en place et autres détails qui n'alimentent pas un compte en banque.

Si vous êtes adepte de Jetstream, il y a aussi une commande pour ça :

```bash
laravel new mon-super-site --jetstream-prompt
```

## Créer un nouveau projet depuis une version expérimentale de Laravel

Pour celles et ceux qui aiment vivre dangereusement, il y a une commande pour ça :

```bash
laravel new mon-super-site --dev
```

À partir de là, vous pourriez apprendre à [créer votre première page](https://larabiz.fr/blog/comment-creer-page-laravel). 🤙
EOT,
            'certified_for_laravel' => 9,
            'created_at' => '2022-02-03 21:41:57',
        ]);

        $post
            ->addMediaFromUrl('https://larabiz.fr/storage/o3IbbaKgpgXPTy2m1FxLd1xDogNcVJwHKf62GX8a.jpg')
            ->toMediaCollection('illustration');

        $post = Post::create([
            'user_id' => 1,
            'title' => 'Comment créer un formulaire avec Laravel',
            'slug' => 'comment-creer-formulaire-laravel',
            'excerpt' => "L'avantage de Laravel, c'est de pouvoir écrire du code simple et concis. Ici, nous allons voir comment créer un formulaire sans fioritures.",
            'content' => <<<'EOT'
Être capable de récolter l'entrée d'un utilisateur sur un site web est primordial. Il y a tout un tas d'applications pour ça comme :
- L'authentification d'un utilisateur ;
- Un panneau d'administration qui permet de poster des articles ;
- Poster des commentaires ;
- Etc.

Afin d'être capable de suivre ce tutoriel, je vous recommande d'être au point avec les routes en allant lire [cet article](https://larabiz.fr/blog/comment-creer-page-laravel) d'abord.

### Création des routes

Dans `routes/web.php`, créons la route permettant d'afficher le formulaire en se rendant sur la page */mon-super-formulaire*.  
On utilisera la méthode `Route::view`, permettant de directement lier une vue à une page. Pourquoi ? Cela nous permet d'écrire moins de code. Donc, plutôt que d'écrire ceci :

```php
Route::get('/mon-super-formulaire', function () {
    return view('mon-super-formulaire');
});
```

On écrira ça :

```php
Route::view('/mon-super-formulaire', 'mon-super-formulaire');
```

Ensuite, la route permettant de traiter les données envoyées par l'utilisateur à travers le formulaire. La particularité, c'est que le navigateur doit envoyer une requête POST à notre site. Nous allons donc faire en sorte que la route réponde à cette méthode HTTP :

```php
Route::post('/traitement-de-mon-super-formulaire', function () {
	// C'est ici qu'on écrira le code.
});
```

### Création de la vue contenant le HTML du formulaire

Nous avons déjà créé la route permettant d'afficher le contenu de la vue `mon-super-formulaire.blade.php`. Mais jusqu'à maintenant, elle renvoyait une erreur car elle n'existait pas. Corrigeons ça sans attendre.

```bash
touch resources/views/mon-super-formulaire.blade.php
```

Dans ce nouveau fichier, ajoutez le code Blade suivant :

```blade
{{-- Notez bien l'utilisation de la méthode HTTP "POST". --}}
<form method="POST" action="/traitement-de-mon-super-formulaire">
	{{-- La directive "csrf" permet de se protéger des attaques CSRF.
	Il s'agit d'un très vaste sujet, alors partons du principe
	qu'elle est requise dans chacun de vos formulaires. --}}
    @csrf

    <input type="text" name="nom" />

    <button type="submit">
	    Envoyer
	</button>
</form>
```

### Traitement des données

Reprenons la route que nous avons créé ci-dessus et ajoutons la validation des données et l'affichage :

```php
// Cette fois, on utilise la méthode HTTP "POST".
Route::post('/traitement-de-mon-super-formulaire', function () {
    // Assurons-nous que ce que saisi l'utilisateur :
	// - N'est pas vide ;
	// - Fait plus de 3 caractères ;
	// - Ne fait pas plus de 255 caractères.
	//
	// Signalons au passage que l'utilisateur a saisi "Homer" dans le formulaire.
	$input = request()->validate([
		'nom' => ['required', 'min:3', 'max:255'],
	]);

	// Pour terminer, on affiche "Bonjour, Homer !";
	return 'Bonjour, ' . $input['nom'] . ' !';
});
```

Plus d'informations sur les différentes règles de validation : https://laravel.com/docs/validation

Après ça, l'idéal serait d'ajouter l'attribut `required` dans le champ du formulaire afin d'avoir une validation aussi bien dans le front-end que le back-end :

```html
<input type="text" name="nom" required />
```

![Capture d'écran de la validation du champ "nom".](https://larabiz.fr/storage/3/conversions/6bb42ead1f8e6ddf07dbaf652eb4da1666a00bc1-large.jpg)

Il est désormais impossible d'envoyer le formulaire sans l'avoir rempli avant. Nous avons maintenant un formulaire parfaitement fonctionnel.

![Capture d'écran de l'affichage du prénom dans le navigateur.](https://larabiz.fr/storage/4/conversions/82cff83c78368491513aff454cc2110c96362d9b-large.jpg)

À vous maintenant de l'intégrer dans un vrai projet si ça vous chante, d'utiliser les controllers, les custom requests et je ne sais quelle autre des nombreuses fonctionnalités de Laravel.
EOT,
            'certified_for_laravel' => 9,
            'created_at' => '2022-02-03 22:34:08',
        ]);

        $post
            ->addMediaFromUrl('https://larabiz.fr/storage/F3avlqxOElk4JT2y8rasBY8CdtAKVhPMYxc0CVIl.jpg')
            ->toMediaCollection('illustration');

        $post
            ->addMediaFromUrl('https://larabiz.fr/storage/3/conversions/6bb42ead1f8e6ddf07dbaf652eb4da1666a00bc1-large.jpg')
            ->toMediaCollection('images');

        $post
            ->addMediaFromUrl('https://larabiz.fr/storage/4/conversions/82cff83c78368491513aff454cc2110c96362d9b-large.jpg')
            ->toMediaCollection('images');

        $post = Post::create([
            'user_id' => 1,
            'title' => 'Comment installer Tailwind CSS 3 dans un projet Laravel',
            'slug' => 'comment-tailwind-css-3-laravel',
            'excerpt' => 'Tailwind CSS déchaine les passions. Certains l’adorent, certains le détestent. Découvrez comment l’intégrer à votre projet Laravel.',
            'content' => <<<'EOT'
[Tailwind CSS](https://tailwindcss.com) est un framework CSS utilisant le concept des classes utilitaires. Il y en a pour quasiment tout et peuvent être combinées ensemble afin de concevoir des interfaces web rapidement sans avoir à vous soucier de l'organisation de vos fichiers ou du nommage de vos classes.

## Installez le package

Installez Tailwind CSS via NPM :

```bash
npm install tailwindcss
```

Le framework dépend de [PostCSS](https://postcss.org). Assurez-vous qu'il est installé également (normalement, toute nouvelle installation de Laravel l'intègre par défaut) :

```bash
npm install postcss --save-dev
```

## Créez le fichier de configuration

Le fichier de configuration de Tailwind vous permettra d'ajouter de nouvelles valeurs au framework et plus encore. C'est une pièce essentielle que vous pouvez créer grâce à la commande suivante :

```bash
npx tailwind init
```

## Configurez Laravel Mix

Dans `webpack.mix.js`, demandez à PostCSS d'utiliser le plugin.

```js
mix.postCss('resources/css/app.css', 'public/css', [
    require('tailwindcss')
])
```

## Ajoutez les directives `@tailwind`

Dans *resources/css/app.css*, nous devons demander à PostCSS d'intégrer tous les styles que génèrera le compilateur Just-in-Time de Tailwind. D'abord les styles de base, ensuite les composants (tel que `.container` par exemple), puis toutes les classes utilitaires que nous connaissons bien.

```css
@tailwind base;
@tailwind components;
@tailwind utilities;
```

## Dites au compilateur JIT où regarder

Maintenant, précisons quels sont les types de fichiers utilisant Tailwind dans `tailwind.config.js`

```js
module.exports = {
    content: [
        "./resources/views/**/*.blade.php",
    ],

    …
}
```

## Codez !

Passons enfin au plus intéressant et demandons à Tailwind de surveiller le moindre changement que nous faisons dans les fichiers que nous avons configurés à l'étape précédente :

```bash
npm run watch
```

Enfin, importez le CSS :

```blade
<!DOCTYPE html>
<html>
	<head>
	    …

	    <link rel="stylesheet" href="{{ mix('/css/app.css') }}" />
	</head>
	<body>
	    …
	</body>
</html>
```

Puis commencez à styler votre HTML ! Exemple :

```html
<button class="bg-blue-400 font-bold px-4 py-3 rounded text-white">
    Envoyer
</button>
```

## Bonus : évitez les problèmes de cache

Afin d'éviter que votre navigateur vous serve une version mise en cache de votre CSS (que vous soyez en local ou en production), ajoutez ceci dans votre `webpack.mix.js`:

```js
mix.version()
```

En coulisse, Laravel Mix ajoutera une query string à la fin de l'URL de votre feuille de style afin que votre navigateur ne puise pas dans son cache.
EOT,
            'certified_for_laravel' => 9,
            'created_at' => '2022-02-05 11:35:10',
        ]);

        $post
            ->addMediaFromUrl('https://user-images.githubusercontent.com/3613731/180869791-63e4cce8-c529-4fd6-97cc-f777f9a28f86.jpg')
            ->toMediaCollection('illustration');

        $post = Post::create([
            'user_id' => 1,
            'title' => 'Comment installer Bootstrap 5 dans un projet Laravel',
            'slug' => 'comment-bootstrap-5-laravel',
            'excerpt' => "Bootstrap est l'outil le plus populaire pour concevoir des interfaces travaillées en un clin d'œil. Intégrons-le dans Laravel grâce à Mix.",
            'content' => <<<'EOT'
## Installer le package

Plutôt que d'utiliser le CDN de Bootstrap, nous allons utiliser Webpack (à travers Laravel Mix). Cela nous permettra plus tard d'inclure seulement les briques que vous utilisez. Mais nous verrons cela plus tard.  
Pour le moment, exécutez la commande suivante :

```bash
# Ou `yarn add bootstrap @popperjs/core`
npm install bootstrap @popperjs/core
```

## Configuration de Laravel Mix

Laravel Mix est une abstraction autour de Webpack. Si vous avez déjà essayé d'utiliser Webpack, vous apprécierez le gain de temps et d'énergie que cet outil vous fera gagner. Et à mon avis, il serait bête de s'en priver.  
Dans votre fichier `webpack.mix.js`, assurez-vous d'avoir ceci :

```js
mix
    .css('resources/css/app.css', 'public/css')
    .js('resources/js/app.js', 'public/js')
```

## Import

Grâce à Webpack, il est possible d'organiser son code JavaScript en modules, tout comme en PHP avec la fonction `include`. Rendez-vous dans `resources/js/app.js` et ajoutez ceci :

```js
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'
```

Oui, nous appelons un fichier CSS dans du JavaScript ! Mais ne vous inquiétez pas, c'est tout à fait normal. Jetez un œil à votre page, vous verez qu'il sera inclut dans une balise `style`.

## Appel du script dans le HTML

Maintenant que tout est compilé, il vous faut appeler le CSS et le JavaScript sur votre page grâce aux balises `link` et `script` :

```blade
<!DOCTYPE html>
<html>
	<head>
	    …

		<link rel="stylesheet" href="{{ mix('/css/app.css') }}" />
	</head>
	<body>
	    …

		<script src="{{ mix('/js/app.js') }}"></script>
	</body>
</html>
```

## Compilation

La dernière étape, c'est la compilation. Il nous faut générer les fichiers `public/css/app.css` et `public/js/app.js`. Utilisez la commande ci-dessous :

```bash
# Ou `yarn dev`
npm run dev
```

## Évitez le cache côté navigateur lorsque le code a changé

Afin d'éviter que votre navigateur vous serve une version mise en cache de votre JavaScript et votre CSS, ajoutez ceci à votre `webpack.mix.js`:

```js
mix
	.css('resources/css/app.css', 'public/css')
    .js('resources/js/app.js', 'public/js')
    .version()
```

En coulisse, Laravel Mix se contentera simplement d'ajouter une query string à la fin de l'URL (exemple : `/css/app.css?id=d907e32d5bfb758e04474f878b0216c3`), ce qui sera suffisant pour faire comprendre à votre navigateur que vous avez besoin de code frais.

## Diminuer la taille de notre fichier en important le strict nécessaire

Lors de la compilation, Laravel Mix prend bien soin de minifier votre JavaScript. Combinez ça a de la compression côté serveur, et on obtient un fichier vraiment light. Il est possible d'aller plus loin encore en important seulement les briques nécessaires de Bootstrap.

Admettons que pour votre site, vous n'utilisez que les alertes et les tooltips. Alors nous changeront notre app.js comme ceci :

```js
import { Alert, Tooltip } from 'bootstrap'
```

C'est terminé, merci de m'avoir lu jusqu'au bout !

Dans le cas où vous préfèreriez un framework CSS moins "couteau Suisse", je vous recommande de vous intéresser à [Tailwind CSS](https://larabiz.fr/blog/comment-tailwind-css-3-laravel).
EOT,
            'certified_for_laravel' => 9,
            'created_at' => '2022-02-05 13:36:48',
        ]);

        $post
            ->addMediaFromUrl('https://user-images.githubusercontent.com/3613731/180869775-216c0437-0627-47ce-999a-f12160d59814.jpg')
            ->toMediaCollection('illustration');

        $post = Post::create([
            'user_id' => 1,
            'title' => 'Découvrez 13 nouveautés et changements dans Laravel 9',
            'slug' => '13-nouveautes-changements-laravel-9',
            'excerpt' => "Laravel 9, la dernière version en date du framework, est truffée de nouveautés et changements divers importants. Je vous présente 13 d'entre eux.",
            'content' => <<<'EOT'
Laravel est mis à jour toute l'année à travers des versions mineures. La différence avec Laravel 9 qui est une version majeure, c'est que de potentiels "breaking changes" ont été introduits et sont susceptibles d'affecter votre code.  
Dans le cas où votre code est testé, vous n'aurez absolument aucun mal à répérer où ça casse et corriger le tir.

## 1. PHP 8.0 minimum est requis

PHP est un langage qui évolue vite. Contrairement à WordPress qui a proposé pendant longtemps une compatibilité avec PHP 5.2, Laravel augmente la version minimum de PHP à chaque occasion. Si vous êtes coincés à la version 7.4 ou moins, c'est le moment de faire du forcing au boulot pour PHP 8 !

## 2. Le dossier `resources/lang` à la racine

Le dossier `resources/lang` a finalement déménagé à la racine afin que le dossier `resources` soit consacré exclusivement au front-end. Pas d'inquiétudes cela dit ; si vous avez mis à jour vers Laravel 9 sans bouger le dossier, tout continuera à fonctionner normalement.

## 3. Nouvelle présentation pour `php artisan route:list`

La précédente version de `route:list` était un cauchemar à l'utilisation. Celle-ci est tellement plus lisible. Je vous laisse apprécier. 👍

![](https://larabiz.fr/storage/21/conversions/3ca4c7ee9269f09f50032c09aa485de65681c58d-large.jpg)

## 4. Générer un test coverage avec `php artisan test`

Le test coverage est loin d'être une métrique infaillible pour déterminer la solidité d'un projet. Néanmoins, si cela encourage les gens à écrire des tests, on ne se plaindra pas !

Installez d'abord Xdebug :

```bash
pecl install xdebug
```

Ajoutez cette ligne dans votre `php.ini` :

```ini
xdebug.coverage=on
```

Enfin, exécutez cette commande Artisan dans votre projet :

```bash
php artisan test --coverage
```

![Le tests coverage dans Laravel 9.](https://larabiz.fr/storage/18/conversions/56052845673eab56d1b5ec6a9f164ed1eead1bee-medium.jpg)

## 5. Les migrations anonymes par défaut

Terminé les conflits au niveau du nommage des migrations. Dorénavant, grâce aux classes anonymes (introduites dans PHP 7), vous pouvez les déclarer comme ceci :

```php
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up() : void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');
            $table->timestamps();
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('posts');
    }
};
```

Pensez à mettre à jour votre dossier `stubs` si c'est quelque chose que vous utilisez.

## 6. Une nouvelle manière de déclarer ses mutators et ses accessors

Avant :

```php
public function getImgAttribute()
{
    return \Storage::url($this->img);
}

public function setImgAttribute($value)
{
    $this->attributes['img'] = trim($value, '/');
}
```

Après :

```php
use Illuminate\Database\Eloquent\Casts\Attribute;

public function img()
{
    return new Attribute(
        fn ($value) => \Storage::url($value),
		fn ($value) => trim($value, '/')
    );
}
```

Ou mieux encore, pour plus de clareté, nous pouvons utiliser les named arguments de PHP 8 :

```php
return new Attribute(
    get: fn ($value) => \Storage::url($value),
    set: fn ($value) => trim($value, '/')
);
```

## 7. Les groupes de routes sous l'égide d'un seul contrôleur

Avez-vous des routes utilisant toutes le même contrôleur ? Il est maintenant possible de les regrouper afin d'éviter de se répéter.

```php
Route::controller(PostController::class)->group(function () {
    Route::get('/blog', 'index')->name('posts.index');
    Route::get('/blog/{post:slug}', 'show')->name('posts.show');
});
```

## 8. Rendu d'une template Blade via une chaine de caractères

Il est désormais possible de faire un rendu d'une template Blade directement depuis une chaine de caractère :

```php
Blade::render(
  '<p>Bonjour, {{ $name }} !</p>',
  ['name' => 'Homer'],
  deleteCachedView: true
);
```

## 9. Une syntaxe plus courte pour les slots des composants Blade

```blade
<x-section>
	<x-slot name="title"> {{-- [tl! --] --}}
    <x-slot:title> {{-- [tl! ++] --}}
		Bonjour, visiteur de Larabiz !
	</x-slot>

	...
</x-section>
```

De quoi nettoyer vos views et passer moins de temps à écrire. 👍

## De nouvelles directives Blade

### 10. `@checked`

```blade
<input
    type="checkbox"
    name="foo"
    value="1"
    @if ($value === 1) checked @endif {{-- [tl! --] --}}
    @checked($value === 1) {{-- [tl! ++] --}}
/>
```

### 11. `@selected`

```blade
<select name="country">
	@foreach ($countries as $country)
		<option
            value="{{ $country }}
            @if ($country === $user->country) selected @endif {{-- [tl! --] --}}
            @selected($country === $user->country) {{-- [tl! ++] --}}
        >
			{{ $country }}
		</option>
	@endforeach
</select>
```

## De nouveaux helpers

### 12. `str()`

```php
use Illuminate\Support\Str; // [tl! --]

// On transforme "ha" en "Hahahahaha!"
echo Str::of('foo') // [tl! --]
echo str('ha') // [tl! ++]
	->repeat(5)
	->headline()
	->append('!');
```

### 13. `to_route()` (également dispo dans Laravel 8)

```php
return redirect()->to('foo'); // [tl! --]
return to_route('foo'); // [tl! ++]
```

Quel intérêt ? C'est tout simplement plus simple à lire.

## Bonus : un nouveau [laravel.com](https://laravel.com)

Il ne s'agit pas d'une nouveauté ayant un vrai rapport avec Laravel 9, mais il est agréable de constater que le site officiel reçoit toute l'attention qu'il mérite. Le design du site a été actualisé et des améliorations ont été faites sur la coloration syntactique des bouts de code.

<figure>
<img src="https://larabiz.fr/storage/17/conversions/48f18889a1a64b511fc01db9aba6fe2846fc9c06-medium.jpg" alt="laravel.com avant." />
<figcaption>Avant.</figcaption>
</figure>

<figure>
<img src="https://larabiz.fr/storage/20/conversions/2670de6252f231496b565a3e4f061af1d20cb4bb-medium.jpg" alt="laravel.com après." />
<figcaption>Après.</figcaption>
</figure>

D'ailleurs, saviez-vous que [laravel.com](https://laravel.com) est open source ? Vous pouvez retrouver le dépôt sur [GitHub](https://github.com/laravel/laravel.com).

À vos clavier, je vous donne rendez-vous dans le [guide de mise à jour](https://laravel.com/docs/9.x/upgrade) officiel de Laravel ! 🥳
EOT,
            'certified_for_laravel' => 9,
            'created_at' => '2022-02-10 17:35:24',
        ]);

        $post
            ->addMediaFromUrl('https://user-images.githubusercontent.com/3613731/180867152-3cf6bd45-3443-4072-95a9-5d6022af15ae.jpg')
            ->toMediaCollection('illustration');

        $post
            ->addMediaFromUrl('https://larabiz.fr/storage/21/3ca4c7ee9269f09f50032c09aa485de65681c58d.jpg')
            ->toMediaCollection('images');

        $post
            ->addMediaFromUrl('https://larabiz.fr/storage/18/56052845673eab56d1b5ec6a9f164ed1eead1bee.jpg')
            ->toMediaCollection('images');

        $post
            ->addMediaFromUrl('https://larabiz.fr/storage/17/48f18889a1a64b511fc01db9aba6fe2846fc9c06.jpg')
            ->toMediaCollection('images');

        $post
            ->addMediaFromUrl('https://larabiz.fr/storage/20/2670de6252f231496b565a3e4f061af1d20cb4bb.jpg')
            ->toMediaCollection('images');

        $post = Post::create([
            'user_id' => 1,
            'title' => 'Laravel VS. Lumen en 2022 : lequel utiliser pour des performances optimales ?',
            'slug' => 'laravel-vs-lumen-2022',
            'excerpt' => "Avec le temps, les choses changent. Les microframeworks n'échappent pas à cette règle et leur pertinence s'amoindrit. Découvrez pourquoi avec Laravel et Lumen.",
            'content' => <<<'EOT'
## Lumen n'est plus activement maintenu

Récemment, le fichier README de Lumen a été mis à jour avec [ce message](https://github.com/laravel/lumen/commit/69b26578d2f15595ea901278434b74df459c4329) (traduit par mes soins) :

> Depuis la sortie de [Lumen](https://lumen.laravel.com), PHP a bénéficié d'une multitude d'améliorations en termes de performances. Pour cette raison, en plus de la disponibilité de [Laravel Octane](https://laravel.com/docs/octane), nous ne recommandons plus de commencer de nouveaux projets avec Lumen. Nous recommandons plutôt [Laravel](https://laravel.com)._

Le message est clair : **ne perdez pas votre temps avec Lumen**. Mais laissez-moi tout de même continuer l'argumentation.

## Le manque de fonctionnalités fait perdre en productivité

Afin d'atteindre ses objectifs en termes de performances, Lumen est débarrassé de tout un tas de fonctionnalités. Certaines ne vous manqueront pas, mais vous pleurerez le départ de celles que vous étiez habitué à utiliser avec Laravel.

## Il y a peu de différence sur un vrai projet en termes de performances

On trouve tout un tas de benchmarks sur le web, comme [celui-ci](https://igliop.medium.com/benchmarking-serverless-laravel-vs-lumen-with-bref-c3bdca37e5b8) ou [celui-là](https://medium.com/@jeffalmeida_27473/laravel-vs-lumen-what-should-i-use-63c196822b2d), et ils en viennent tous à la même conclusion : dans le contexte d'un vrai projet, la différence est quasiment imperceptible.

## Laravel est plus rapide que Lumen grâce à Octane

Le principe est simple (sur le papier) : Octane garde en mémoire le processus de bootstrapping de Laravel. Ainsi, à chaque requête, seul votre code est exécuté. Cela se traduit la plupart du temps en des gains de performances de l'ordre de 50% (exemple [ici](https://moduscreate.com/blog/boost-your-laravel-project-performance-with-octane/) ou [là](https://medium.com/geekculture/speed-up-your-laravel-projects-using-laravel-octane-swoole-server-a39f4a7fa889)). Ceci dit, il faut garder à l'esprit qu'un projet avec Octane a ses particularités et il y a quelques dispositions à prendre au niveau de votre code. Mais si vous êtes intéressés, je vous laisse consulter la [documentation](https://laravel.com/docs/octane).

## Conclusion

Pour des performances et une productivité accrues, utilisez Laravel + Octane. Lumen a fait son temps et le moment est venu pour lui de prendre sa retraite.
EOT,
            'certified_for_laravel' => 9,
            'created_at' => '2022-03-03 17:20:03',
        ]);

        $post
            ->addMediaFromUrl('https://larabiz.fr/storage/2bNSUy4X0IKUbtaqtTO5Nuj4GSYC9prgWwaGXOMe.jpg')
            ->toMediaCollection('illustration');

        $post = Post::create([
            'user_id' => 1,
            'title' => 'Pourquoi utiliser Laravel en 2022 ? Voici 5 raisons.',
            'slug' => 'pourquoi-laravel-2022-5-raisons',
            'excerpt' => "Débuter en PHP n'est pas évident. L'écosystème est énorme et il est difficile de se décider sur un framework. Découvrez pourquoi choisir Laravel en 2022.",
            'content' => <<<'EOT'
Le but de cet article n'est pas d'énoncer toutes les fonctionnalités de Laravel (pour ça, vous avez la [documentation officielle](https://laravel.com/docs)).  
Je suis plutôt là pour vous soulager du fardeau du choix en vous présentant les possibilités du framework *dans les grandes lignes* afin que vous ayez une vision claire des bénéfices.

Avant de commencer, je pense qu'il est utile de rappeler pourquoi vous êtes confrontés au choix d'un framework :

- Constamment réinventer la roue à chaque nouveau projet est une perte de temps. Le temps, c'est de l'argent. Un client heureux est un client qui est satisfait de la rapidité et de la qualité de votre travail ;
- Les entreprises l'ont bien compris. Rarement vous trouverez une offre d'emploi ne demandant pas la maitrise d'un framework ;
- Le code d'un framework est écrit, testé et éprouvé par des milliers de développeurs. Peu importe votre niveau d'expérience, votre code sera toujours moins fiable.

Répondons maintenant à ce fameux "pourquoi" !

## Une accessibilité déconcertante

Laravel est un framework doté d'une syntaxe simple et élégante. Il est aisément possible d'écrire du code concis, qui se lit comme de l'anglais.

Disons que nous souhaitons ajouter un produit dans notre table `products`. Voici comment faire avec Symfony :

```php
$entityManager = $doctrine->getManager();

$product = new Product();
$product->setName('Keyboard');
$product->setPrice(1999);
$product->setDescription('Ergonomic and stylish!');

$entityManager->persist($product);

$entityManager->flush();
```

La même chose, mais avec Laravel :

```php
Product::create([
	'name' => 'Keyboard',
	'price' => 1999,
	'description' => 'Ergonomic and stylish!',
]);
```

Chaque approche a ses forces et ses faiblesses. Au final, il est possible de faire les mêmes choses quel que soit l'outil que vous utilisez. Personnellement, j'apprécie l'élégance, le pragmatisme et la non-conformité de Laravel. Le code est moins intimidant, ce qui rend le framework plus facile à appréhender.

## Un écosystème officiel et tierce-partie complet qui vous aide à créer de la valeur

## Une communauté accueillante qui vous aidera du mieux qu'elle peut

## Un framework qui évolue rapidement

Laravel respecte l'organisation suivante :
- Une version majeure par an (exemple : 9) ;
- Une version mineure plusieurs fois par mois (exemple : 9.1) ;
- Une version patch aussi souvent que cela est nécessaire (exemple : 9.1.1).

Regardez [le changelog](https://github.com/laravel/framework/blob/9.x/CHANGELOG.md), vous verrez à quel point l'équipe de Taylor Otwell et les contributeurs ne chôment pas.

Chaque nouvelle fonctionnalité ajoutée dans une version mineure est testée afin qu'elle ne casse pas la compatibilité avec votre code.
Par exemple, si votre *composer.json* requiert `laravel/framework: "^9/0"`, alors vous pouvez être assurés que votre code ne cassera pas en production après un `composer update`.

Bien sûr, certains d'entre vous savent peut-être que le seul véritable moyen d'assurer la stabilité d'un projet est d'écrire des tests automatisés. Et justement, il s'agit d'un des points forts de Laravel.

## Écrire des tests automatisés avec Laravel est une promenade de santé

L'écriture de tests automatisés est un sujet énorme en programmation. **Laravel vous permet de facilement vous lancer dans cette discipline que tout développeur expérimenté devrait maitriser**.

- **_Être capable d'écrire des tests fera de vous un développeur plus fiable._**
- Validez le comportement de votre application, de manière automatisée ;
- Moins de tâches fastidieuses. Plutôt que d'ouvrir votre navigateur ou client HTTP, lancez vos tests avec votre raccourci clavier ou votre commande favorite. 10 fois, 100 fois, peu importe ! Les tests s'exécutent en quelques secondes seulement ;
- Écrire des tests prévient les bugs. Bien sûr, tout cela dépendra de la couverture de vos tests, mais vous obtiendrez des résultats *toujours* meilleurs ;
- Couplez vos tests à de l'intégration continue. Commitez, pushez et seulement si vos tests passent, alors le code sera déployé en production.

Il y a plein d'autres avantages à écrire des tests. Et il en existe plusieurs types. Mais pour ceux qui n'ont pas d'expérience en la matière, je pense vous avoir donné suffisamment d'éléments pour vous donner envie de creuser le sujet.  
Plus d'informations sur [la documentation officielle des tests](https://laravel.com/docs/testing).

## Conclusion

Laravel est un framework accessible de par son approche pragmatique du code. Il est performant, extensible, soutenu par une large communauté et vous aidera à atteindre vos objectifs.  
Investir dans l'apprentissage de ce framework vous permettra d'améliorer la satisfaction de votre employeur, de vos clients ou de contribuer au succès de votre startup.
EOT,
            'certified_for_laravel' => 9,
            'created_at' => '2022-03-08 00:19:18',
        ]);

        $post
            ->addMediaFromUrl('https://larabiz.fr/storage/uKh5vPr2BHWZ53bT9khO63u6SU3p3wMU0jw2sfTq.jpg')
            ->toMediaCollection('illustration');

        $post = Post::create([
            'user_id' => 1,
            'title' => 'Comment créer un contrôleur avec Laravel',
            'slug' => 'comment-creer-controleur-laravel-artisan',
            'excerpt' => 'Artisan nous offre la possibilité de gagner du temps en générant les classes les plus utilisées dans un projet Laravel. Intéressons-nous aux contrôleurs.',
            'content' => <<<'EOT'
Créer un contrôleur (ou "controller" en anglais) est une tâche récurrente lorsque l'on développe avec Laravel. Il s'agit d'un élément essentiel du framework étant donné qu'il repose sur le modèle de conception MVC (Model View Controller).

*Attention, cet article part du principe que vous savez déjà à quoi sert un contrôleur.*

## Créer un contrôleur avec Artisan

Commençons par créer un contrôleur sous sa forme la plus simple grâce à la commande suivante :

```bash
php artisan make:controller PostController
```

Rendez-vous dans *app/Http/Controllers* et ouvrez *PostController.php* afin de voir à quoi cela ressemble.

```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //
}
```

Bien entendu, il est possible de gagner plus de temps en générant des contrôleurs plus complexes.

## Créer un contrôleur invokable

Les contrôleurs invokables sont extrêmement utiles. Admettons que vous scindiez chacune de vos actions CRUD (Create, Read, Update et Delete) dans un contrôleur unique. Au lieu de créer, par exemple, une méthode `store` dans votre contrôleur `StorePostController`, vous pourriez plutôt utiliser [la méthode magique `__invoke` de PHP](https://www.php.net/manual/fr/language.oop5.magic.php#object.invoke).

```bash
php artisan make:controller StorePostController --invokable
```

```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StorePostController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }
}
```

Ensuite, dans votre fichier `routes/web.php`, vous pouvez faire pointer la route vers votre contrôleur :

```php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StorePostController;

Route::post('/posts', [StorePostController::class, 'store']); // [tl! --]
Route::post('/posts', StorePostController::class); // [tl! ++]
```

Pratique, n'est-il pas ? 🇬🇧

## Créer un contrôleur pour une ressource

Selon vos préférences, vous aurez peut-être envie de regrouper toutes vos méthodes CRUD pour un modèle donné dans un seul contrôleur.

Ne bougez pas, Laravel assure vos arrières !

```bash
php artisan make:controller PostController --resource
```

Ce qui donnera :

```php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
	…

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    …
```

Notez que Laravel aura automatiquement deviné quel modèle nous souhaitons utiliser, car il existe déjà et nous respectons les conventions de nommage et d'organisation du framework.

Bien entendu, il est possible de spécifier le chemin vers votre modèle manuellement dans le cas où votre projet aurait une structure plus exotique.

```bash
php artisan make:controller PostController --resource --model="App\Model\Post"
```

## Créer un contrôleur pour une ressource destinée à être exposée via une API RESTful

Pour celles et ceux qui développent une API RESTful, sachez que vous pouvez complètement omettre les méthodes `create` et `edit` de votre CRUD. En effet, celles-ci servent essentiellement à présenter des formulaires. Formulaires complètement inutiles dans cette circonstance.

```bash
php artisan make:controller PostController --api
```

## Créer un contrôleur pour une ressource ayant un parent

Imbriquer vos resources est une bonne pratique et vous fera également économiser quelques lignes de code.

Disons que nous avons des commentaires associés à chaque post.

```php
use Illuminate\Support\Facades\Route;

Route::resource('posts.comments');
```

Nous pouvons générer en une seule commande un contrôleur prenant en compte cette spécificité.

```bash
php artisan make:controller CommentController --resource --parent="App\Model\Post"
```

```php
namespace App\Http\Controllers;

use App\Model\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
	…

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @param  \App\Model\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @param  \App\Model\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Comment $comment)
    {
        //
    }
}
```

## Conclusion

Un contrôleur Laravel peut prendre différentes formes selon l'usage que l'on veut en faire et Artisan vous permet d'en créer une sacrée variété en un clin d'œil.
Ouvrez votre Terminal et exécutez la commande `php artisan help make:controller`, car il y a encore beaucoup d'autres options dont je n'ai pas parlé. 👍
EOT,
            'certified_for_laravel' => 9,
            'created_at' => '2022-04-18 16:04:34',
        ]);

        $post
            ->addMediaFromUrl('https://user-images.githubusercontent.com/3613731/180867647-2a5dfd43-b9df-4461-948b-9384612c14f4.png')
            ->toMediaCollection('illustration');

        $post = Post::create([
            'user_id' => 1,
            'title' => 'Comment créer un modèle, une migration et plus encore avec Artisan',
            'slug' => 'comment-creer-modele-migration-laravel-artisan',
            'excerpt' => 'Créer les fichiers et le code de base pour chaque modèle Eloquent peut rapidement devenir répétitif. Heureusement, Artisan vient à notre rescousse.',
            'content' => <<<'EOT'
## Créer un modèle avec Artisan

Ici, rien de farfelu. Cette commande vous permettra de générer un modèle "Post" que vous retrouverez dans le dossier *app/Models*.

```bash
php artisan make:model Post
```

## Créer un modèle accompagné d'une migration

Savez-vous qu'il est aussi possible de générer une migration correspondant au modèle ?

*Peuh, trop facile, il suffit de faire ça !*

```bash
php artisan make:migration create_posts_table
```

Eh bien oui ! On peut le faire. Mais il y a plus rapide encore. Lorsqu'on créer un modèle, il est tout simplement possible de lui demander de créer une migration en même temps grâce à l'option `--migration` (ou `-m` pour faire plus court) !

```bash
php artisan make:model Post -m
```

Rendez-vous dans *database/migrations*. 👍

## Créer un modèle, une migration et une factory

Maintenant que nous avons le modèle et la migration, nous pouvons avancer dans le développement de notre projet.  
Mais si vous souhaitez avoir un environnement de développement local optimal, je vous conseille d'utiliser les factories.

Cet article n'est pas là pour vous aider à comprendre à quoi elles servent, mais pour résumer en deux phrases, les factories permettent de générer en quantité illimitée des modèles en base de donnée. Il est même possible d'utiliser [Faker](https://github.com/FakerPHP/Faker) (accessible depuis les factories) pour injecter de la fake data générée aléatoirement, tels que des noms, adresses e-mails, adresses postales, et j'en passe.

Pour en revenir à Artisan, nous allons utiliser la même commande que ci-dessus, tout en y ajoutant une option `--factory` (ou `-f` pour faire plus court).

```bash
php artisan make:model Post -mf
```

Vous trouverez la factory fraîchement créée dans *database/factories*.

## Créer un modèle, une migration, une factory, une policy, un controller et plus encore

Vous l'aurez compris, la commande `php artisan make:model` peut recevoir une flopée d'options. Options visibles avec la commande `php artisan help make:model`.  
En voici la liste dans le cas où vous ne seriez pas devant votre ordinateur :

```bash
php artisan help make:model

Description:
  Create a new Eloquent model class

Usage:
  make:model [options] [--] <name>

Arguments:
  name                  The name of the class

Options:
  -a, --all             Generate a migration, seeder, factory, policy, and resource controller for the model
  -c, --controller      Create a new controller for the model
  -f, --factory         Create a new factory for the model
      --force           Create the class even if the model already exists
  -m, --migration       Create a new migration file for the model
      --morph-pivot     Indicates if the generated model should be a custom polymorphic intermediate table model
      --policy          Create a new policy for the model
  -s, --seed            Create a new seeder for the model
  -p, --pivot           Indicates if the generated model should be a custom intermediate table model
  -r, --resource        Indicates if the generated controller should be a resource controller
      --api             Indicates if the generated controller should be an API controller
  -R, --requests        Create new form request classes and use them in the resource controller
      --test            Generate an accompanying PHPUnit test for the Model
      --pest            Generate an accompanying Pest test for the Model
  -h, --help            Display help for the given command. When no command is given display help for the list command
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi|--no-ansi  Force (or disable --no-ansi) ANSI output
  -n, --no-interaction  Do not ask any interactive question
      --env[=ENV]       The environment the command should run under
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
```

## Aller plus loin

La génération de code via Artisan peut faire gagner un temps considérable sur le long terme. Mais nous pouvons aller plus loin encore en customisant les stubs ("souche" en français) qu'il utilise afin d'avoir une plus grande liberté sur le code généré et son format.

```bash
php artisan stub:publish
```

Plus d'informations sur [la documentation officielle](https://laravel.com/docs/9.x/artisan#stub-customization).
EOT,
            'certified_for_laravel' => 9,
            'created_at' => '2022-05-23 07:51:56',
        ]);

        $post
            ->addMediaFromUrl('https://larabiz.fr/storage/FIhHrH9SzaWHnvfG4V4a2WuZlX5h5QtJsYCfID5U.jpg')
            ->toMediaCollection('illustration');

        $post = Post::create([
            'user_id' => 1,
            'title' => 'Comment installer Laravel sur Mac sans avoir recours à Docker grâce à Valet',
            'slug' => 'comment-installer-laravel-mac-valet-docker',
            'excerpt' => "Laravel Valet permet de déployer un environnement de développement sur votre machine en moins de temps qu'il n'en faut pour le dire. Découvrez comment faire.",
            'content' => <<<'EOT'
Étant partisan du pragmatisme et ayant beaucoup de mal à supporter les contraintes d'un environnement basé sur Docker, je prêche régulièrement les bienfaits de [Laravel Valet](https://laravel.com/docs/valet). Cet outil officiel vous permet de mettre en place un environnement de développement Laravel (voir même Symfony ou WordPress) d'un simple claquement de doigts. En fonction de la vitesse de votre connexion internet et de votre machine, cela peut être réglé en l'espace de 5 minutes.

## Installer le gestionnaire de packages Homebrew

Homebrew est un gestionnaire de packages Mac maintenu par la communauté. Si vous êtes familier avec APT (Advanced Package Tool) sur Debian et ses dérivés, vous vous sentirez comme à la maison. Vous trouverez les instructions sur le site officiel de Homebrew. Il n'y a qu'une seule commande à exécuter :

```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```

Lors de l'installation, vous aurez peut-être à installer Xcode Command Line Tools. Je vous rassure : vous n'avez pas à vous soucier de sa fonction. Il est simplement utile de le mentionner, car son installation peut prendre un peu de temps (et il est impossible de s'en passer, car Homebrew dépend de ce dernier).

## Installer PHP, Composer et compagnie

Une fois l'installation d'Homebrew terminée, nous pouvons enfin installer les outils qui nous concernent :

```bash
brew install composer
```

Cette commande rapatriera également PHP, car Composer est basé sur ce dernier comme vous le savez. Par conséquent, aucun besoin de faire `brew install php`.

Sachez qu'il est aussi possible d'installer d'autres outils tels que MySQL, Node.js et Redis qui vous seront utiles voir mêmes indispensables dans un environnement Laravel.

```bash
brew install mysql node redis
```

## Ajouter Valet et l'installeur officiel de Laravel

Valet et l'installeur officiel de Laravel sont des packages Composer. Vous avez certainement l'habitude d'installer des packages dans vos projets (exemple : `composer require laravel/fortify`). Mais cette fois-ci, nous allons le faire de manière globale. Ce qui veut dire qu'ils ne seront rattachés à aucun projet.

```bash
composer global laravel/valet laravel/installer
```

Théoriquement, à l'issue de cette installation, nous devrions être capables de configurer Laravel Valet grâce à la commande `valet install`. Mais si vous essayez de l'exécuter, vous vous rendrez compte que votre terminal n'a absolument aucune idée de ce qu'il est censé faire.
L'astuce, c'est de spécifier le chemin complet vers le binaire comme ceci :

```bash
~/.composer/vendor/bin/valet install
```

Nous sommes d'accord, il est possible de faire mieux. Ce qui nous amène à l'étape suivante.

## Ajouter les binaires des packages Composer dans votre PATH

La variable d'environnement `PATH` contient une liste de dossiers (séparés par `:`). Chacun de ces dossiers contient des binaires et votre terminal saura, par exemple, que lorsque vous souhaiterez utiliser PHP en ligne de commande, il devra aller chercher le binaire `php` dans le dossier `/opt/homebrew/bin`.

```bash
echo $PATH
```

Dans notre cas, nous souhaitons dire au terminal d'également prendre en compte le dossier `~/.composer/vendor/bin` (où se trouvent les binaires `valet` et `laravel`).  
Pour cela, nous allons ajouter le dossier à notre PATH comme ceci :

```bash
echo "export PATH=$PATH:$HOME/.composer/vendor/bin" >> ~/.bash_profile
```

Ensuite, demandons à notre terminal de prendre en compte la nouvelle configuration :

```bash
source ~/.bash_profile
```

**Pour ceux utilisant [Oh My Zsh](https://ohmyz.sh), faites plutôt ça dans `~/.zshrc`.**

Pour les plus curieuses et curieux d'entre vous, décomposons ce que nous venons de faire :

- `export PATH=` permet de définir une variable d'environnement et de lui affecter la valeur de notre choix.
- `export PATH=$PATH` permet d'affecter notre nouvelle variable PATH à la valeur de la variable PATH déjà définie. En gros, après cette commande, PATH sera égale à `dossier1:dossier2:dossier3:…`.
- `export PATH=$PATH:$HOME/.composer/vendor/bin` nous permet tout simplement de faire en sorte que notre variable PATH soit égale à `dossier1:dossier2:dossier3:/Users/Homer/.composer/vendor/bin`

## Configurer Laravel Valet

Maintenant que nos binaires `valet` et `laravel` sont accessibles sans avoir à entrer leur chemin complet, configurons Valet en utilisant la commande suivante :

```bash
valet install
```

Ensuite, créons un dossier qui contiendra tous nos projets web. Pour ma part, je les mets tous dans un dossier *Sites* à la racine de mon dossier utilisateur.

```bash
mkdir ~/Sites
```

Rendez-vous dans ce nouveau dossier et demandons à Valet de rendre disponible chaque projet sur un domaine en *.test* :

```bash
cd ~/Sites
valet park
```

À partir de là, tout devrait être OK. Vous devriez être en mesure d'exécuter un simple `laravel new hello-world` et d'y accéder via [http://hello-world.test](http://hello-world.test)

## Autoriser Valet à être exécuté sans privilèges (sudo)

Une chose assez fastidieuse que vous remarquerez au fur et à mesure que vous utiliserez Valet, c'est de constamment avoir à entrer votre mot de passe administrateur. Afin d'y remédier, il existe une simple commande pour que notre terminal fasse confiance à Valet.

```bash
valet trust
```

## Autoriser l'accès à un site via HTTPS

Pouvoir accéder à un site local via HTTPS présente plusieurs avantages. Valet propose la commande `secure` :

```bash
valet secure hello-world
```

Et pour revenir en arrière :

```bash
valet unsecure hello-world
```

## Exécuter un site via une version différente de PHP

Dans le cas où l'un des projets sur lesquels vous travaillez requiert une version différente de PHP, sachez qu'il est possible de demander à Valet d'utiliser une autre version de PHP :

```bash
valet use php@8.0
```

En revanche, la plupart des gens aimeraient changer la version de PHP seulement pour un site en particulier. Depuis peu, Valet permet de le faire :

```bash
valet isolate --site hello-world php@8.0
```

Bien sûr, il est aussi possible de revenir en arrière :

```bash
valet unisolate --site hello-world
```
EOT,
            'certified_for_laravel' => 9,
            'created_at' => '2022-06-28 12:42:17',
        ]);

        $post
            ->addMediaFromUrl('https://larabiz.fr/storage/LTFRCPtx77VN3JzU0fU5pKDsTqG8dbk1DdK82Yzw.jpg')
            ->toMediaCollection('illustration');

        $post = Post::create([
            'user_id' => 1,
            'title' => "Avant d'utiliser le système de files d'attente de Laravel, essayez dispatchAfterResponse()",
            'slug' => 'files-attente-queues-laravel-dispatch-after-response',
            'excerpt' => 'Il est primordial dans votre carrière que vous appreniez à ne pas déployer des solutions trop sophistiquées pour des besoins modestes. Laravel en est conscient et propose des solutions.',
            'content' => <<<'EOT'
Les files d'attentes sur Laravel (ou queues) permettent d'exécuter des tâches chronophages en arrière-plan sans faire attendre vos visiteurs devant un écran de chargement.

Cependant, il y a certaines tâches, comme l'envoi d'un simple e-mail, qui ne devraient pas avoir besoin d'une telle infrastructure. L'idéal serait de pouvoir afficher votre page sur le navigateur de l'utilisateur et *ensuite* déclencher l'envoi de l'e-mail.

Prenons un formulaire d'abonnement à une newsletter comme exemple :
- L'utilisateur valide son intention de s'abonner en cliquant sur le bouton "M'abonner" après avoir entré son adresse ;
- Il est quasi-instantanément redirigé vers une page lui demandant surveiller sa boîte de réception pour l'e-mail de confirmation ;
- L'envoi de l'e-mail est déclenché juste après, ce qui permet de ne pas avoir une latence d'une à deux secondes avant d'afficher la page mentionnée à l'étape précédente.

Comment arrive-t-on a un tel résultat sans utiliser les queues ? Tout simplement en utilisant la méthode `dispatchAfterResponse()ˋ.
Imaginons notre contrôleur :

```php
public function store(StoreSubscriberRequest $request)
{
    // 1. On crée notre subscriber non-confirmé.
    Subscriber::create($request->validated());

    // 3. On envoie l'e-mail de confirmation.
    dispatch(function () {
        //
    })->afterResponse();
    // Ou :
    // MonJobPasTropLongAExecuter::dispatchAfterResponse();

    // 2. On redirige l'utilisateur vers la page lui demandant de vérifier sa boite mail pour la confirmation.
    return to_route('pending-subscription');
}
```

**Précisons que ce code n'aura l'effet désiré que si vous utilisez PHP-FPM. (Ce qui est probablement le cas pour 99% d'entre-vous.)**

Bien sûr, il s'agit d'une feature à utiliser avec parcimonie et seulement pour des tâches courtes, car il y a peu de chances que vous saturiez votre serveur de cette manière.

Pour des besoins plus avancés, utiliser le système de queues de Laravel vous permettra d'exécuter les tâches au compte-gouttes et avec un parallélisme approprié à la configuration de votre machine afin de ne pas y mettre le feu.
EOT,
            'certified_for_laravel' => 9,
            'created_at' => '2022-07-06 09:14:37',
        ]);

        $post
            ->addMediaFromUrl('https://larabiz.fr/storage/e10e48cd9bd3cc3c461da73b6f0b0d11ef66eb18.jpg')
            ->toMediaCollection('illustration');

        $post = Post::create([
            'user_id' => 1,
            'title' => 'Devenir développeur web PHP en 2022 : 4 points importants après votre première embauche',
            'slug' => 'devenir-developpeur-web-php-2022-4-points-importants-embauche-emploi',
            'excerpt' => "Être un développeur apprécié et respecté fera de vous une personne hautement employable. Voici quelques conseils de la part de quelqu'un n'ayant jamais rien fait pour que cela lui arrive.",
            'content' => <<<'EOT'
## Soyez modestes

Lorsque je suis devenu développeur employé en 2013, j'ai débuté une période très arrogante à la suite de quelques succès.

Par exemple, lors de mon entretien d'embauche dans une agence de communication, il m'a fallu modifier un projet existant en respectant un cahier des charges. Rien d'exceptionnel, il s'agit d'une tâche potentiellement très simple. Ceci étant dit, j'ai appris plus tard que le développeur ayant passé son entretien après moi s'était simplement contenté de copier/coller mon travail. J'y ai vu là une confirmation de ma supériorité par rapport aux autres développeurs de niveau équivalent (ce qui est puéril).

Ajoutez à ça le fait j'étais entièrement autodidacte, ou que mon arrivé dans l'agence nous a permis de basculer sur WordPress, ce qui a grandement amélioré notre productivité. (Ils avaient pour habitude de réinventer la roue à chaque projet.)  Par conséquent, je contribuais à la montée en compétences du responsable du pôle web de l'entreprise (plus âgé et plus expérimenté) et on venait souvent me demander lorsqu'il y avait une question technique.

Croyez-moi, la largeur de mes chevilles augmentait à vue d'oeil.

Toutes ces choses positives ne valent malheureusement pas grand chose lorsque votre attitude est déplorable. Si vous vous reconnaissez, arrêtez tout de suite. **Ne vous vantez pas en étalant vos connaissances** et **ne rabaissez pas vos collègues**. **Soyez bienveillants** et votre réputation s'en trouvera améliorée.

## Personne n'est parfait. Un code livré est préférable à un code parfait.

Avez-vous entendu parler des chimères ? Savez-vous ce qu'elles ont en commun avec la perfection ? Voici ce que Wikipédia nous dit à leur sujet :

> Une chimère, est une idée irrationnelle produite par l'imagination, un fantasme irréalisable.

C'est l'analogie idéale. La perfection *"est une idée irrationnelle produite par l'imagination, un fantasme irréalisable."* C'est aussi un concept hautement subjectif. Ce qui rend votre code parfait à vos yeux ne l'est pas forcément pour les autres, ni même à ceux de votre vous futur.

Passer un temps considérable sur la forme au détriment du reste peut être extrêmement néfaste pour votre carrière.  
Il faut aussi bien garder à l'esprit que les gens pour qui vous produisez le code se moquent de savoir si que vous utilisez un design pattern quelconque ou je ne sais quelle autre fantaisie qui ne fait fantasmer qu'un développeur.  
**Leur but est que votre code génère un retour sur investissement, car vous avez été payé pour ça**.

Lorsque vous travaillez sur un projet, il est important qu'il soit livré dans un état décent. Mais ne retardez pas la livraison pour des problèmes ou des besoins qui ne se poseront peut-être jamais.

**Faites seulement ce qu'on vous demande et corrigez seulement les bugs auxquels vous êtes confrontés. Votre employeur a besoin de quelqu'un d'efficace.**

Imaginez-vous un instant avoir commandé une nouvelle maison et voir le chantier prendre un retard considérable car l'artisan a décidé de s'attarder sur l'apparence du carrelage ou de poser une porte au plafond au cas où vous aimeriez faire un autre étage ([exemple ici](https://www.youtube.com/watch?v=dEP7aEyTOf0)). Nous sommes d'accord, personne n'a envie d'être confronté à ce genre de situation.

## Soyez pragmatiques

Même les plus grands font appel à l'open source, Google et Stack Overflow.

## Celui qui sait qu'il ne sait pas sait beaucoup.

## Conclusion

Modestie et pragmatisme sont les maîtres-mots. Accumulez de l'expérience en gardant à l'esprit tout ce que vous avez lu jusqu'à maintenant et allez plus loin seulement après mûre réflexion.
EOT,
            'certified_for_laravel' => null,
        ]);

        $post
            ->addMediaFromUrl('https://user-images.githubusercontent.com/3613731/181029204-7a461f9f-66f3-4c8f-aba4-ed4fe2eda68b.jpg')
            ->toMediaCollection('illustration');
    }
}
