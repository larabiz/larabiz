<!--
Author: Benjamin Crozat
Image: https://res.cloudinary.com/benjamin-crozat/image/upload/q_auto/f_auto/v1657461035/blog/F3avlqxOElk4JT2y8rasBY8CdtAKVhPMYxc0CVIl_iny4yp.jpg
Title: Comment créer un formulaire avec Laravel
Excerpt: L'avantage de Laravel, c'est de pouvoir écrire du code simple et concis. Ici, nous allons voir comment créer un formulaire sans fioritures.
Certified for Laravel Version: 9
-->

Être capable de récolter l'entrée d'un utilisateur sur un site web est primordial. Il y a tout un tas d'applications pour ça comme :
- L'authentification d'un utilisateur ;
- Un panneau d'administration qui permet de poster des articles ;
- Poster des commentaires ;
- Etc.

Afin d'être capable de suivre ce tutoriel, je vous recommande d'être au point avec les routes en allant lire [cet article](https://larabiz.fr/blog/comment-creer-page-laravel) d'abord.

### Création des routes

Dans `routes/web.php`, créons la route permettant d'afficher le formulaire en se rendant sur la page */mon-super-formulaire*.  
On utilisera la méthode `Route::view`, permettant de directement lier une vue à une page. Pourquoi ? Cela nous permet d'écrire moins de code. Donc, plutôt que d'écrire ceci :

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
