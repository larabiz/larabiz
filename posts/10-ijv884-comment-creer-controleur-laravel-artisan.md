<!--
Author: Benjamin Crozat
Image: https://res.cloudinary.com/benjamin-crozat/image/upload/q_auto/f_auto/v1657460119/blog/fd805668404170308f9066e6946b558a1bf0db6b_byomfl.png
Title: Comment créer un contrôleur avec Laravel
Excerpt: Artisan nous offre la possibilité de gagner du temps en générant les classes les plus utilisées dans un projet Laravel. Intéressons-nous aux contrôleurs.
Certified for Laravel Version: 9
-->

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

Ensuite, dans votre fichier `routes/web.php`, au lieu d'écrire :

```php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StorePostController;

Route::post('/posts', [StorePostController::class, 'store']);
```

Vous pouvez maintenant faire :

```php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StorePostController;

Route::post('/posts', StorePostController::class);
```

Pratique, n'est-il pas ? 🇬🇧

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
