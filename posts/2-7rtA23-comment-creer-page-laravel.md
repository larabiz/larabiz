<!--
Author: Benjamin Crozat
Image: https://res.cloudinary.com/benjamin-crozat/image/upload/q_auto/f_auto/v1657461038/blog/w2txfZFXQ0Dvraig533tB64R3CBwX2eevvVVHDLy_dsc5ls.jpg
Title: Comment créer une page avec Laravel
Excerpt: Afin de créer une page sur Laravel, il nous faut comprendre les bases du système de routing. Nous allons voir à quel point c'est extrêmement simple.
Certified for Laravel Version: 9
-->

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

Maintenant que votre page est créée, pourquoi ne pas [apprendre à créer des formulaires](https://larabiz.fr/blog/comment-creer-formulaire-laravel) ? Il vous faudra aussi les styliser et j'ai écrit deux articles à propos de l'[intégration de Tailwind CSS](https://larabiz.fr/blog/comment-tailwind-css-3-laravel) et [Bootstrap](https://larabiz.fr/blog/comment-bootstrap-5-laravel) dans un projet Laravel.

Bonne chance dans votre apprentissage et à bientôt sur Larabiz. 👋
