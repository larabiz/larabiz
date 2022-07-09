<!--
Author: Benjamin Crozat
Image: https://res.cloudinary.com/benjamin-crozat/image/upload/q_auto/f_auto/v1657461037/blog/xJnxBPTPtFJWqpi1Xg0Rtj4FPZruGjMLyhK1SHIx_z8j8i8.jpg
Title: Découvrez 13 nouveautés et changements dans Laravel 9
Excerpt: Laravel 9, la dernière version en date du framework, est truffée de nouveautés et changements divers importants. Je vous présente 13 d'entre eux.
Certified for Laravel Version: 9
-->

Laravel est mis à jour toute l'année à travers des versions mineures. La différence avec Laravel 9 qui est une version majeure, c'est que de potentiels "breaking changes" ont été introduits et sont susceptibles d'affecter votre code.  
Dans le cas où votre code est testé, vous n'aurez absolument aucun mal à répérer où ça casse et corriger le tir.

## 1. PHP 8.0 minimum est requis

PHP est un langage qui évolue vite. Contrairement à WordPress qui a proposé pendant longtemps une compatibilité avec PHP 5.2, Laravel augmente la version minimum de PHP à chaque occasion. Si vous êtes coincés à la version 7.4 ou moins, c'est le moment de faire du forcing au boulot pour PHP 8 !

## 2. Le dossier `resources/lang` à la racine

Le dossier `resources/lang` a finalement déménagé à la racine afin que le dossier `resources` soit consacré exclusivement au front-end. Pas d'inquiétudes cela dit ; si vous avez mis à jour vers Laravel 9 sans bouger le dossier, tout continuera à fonctionner normalement.

## 3. Nouvelle présentation pour `php artisan route:list`

La précédente version de `route:list` était un cauchemar à l'utilisation. Celle-ci est tellement plus lisible. Je vous laisse apprécier. 👍

![](https://larabiz.fr/storage/21/conversions/3ca4c7ee9269f09f50032c09aa485de65681c58d-medium.jpg)

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
            $table->softDeletes();
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

Avez-vous des routes utilisant toutes le même contrôleur ? Il est maintenant possible de les regrouper afin d'éviter de se répéter.

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

Plutôt que de faire :

```blade
<x-section>
	<x-slot name="title">
		Bonjour, visiteur de Larabiz !
	</x-slot>

	...
</x-section>
```

Vous pouvez maintenant faire :

```blade
<x-section>
	<x-slot:title>
		Bonjour, visiteur de Larabiz !
	</x-slot>

	...
</x-section>
```

De quoi nettoyer vos views et passer moins de temps à écrire. 👍

## De nouvelles directives Blade

### 10. `@checked`

Ceci :

```blade
<input type="checkbox" name="foo" value="1" @if ($value === 1) checked @endif />
```

Devient cela :

```blade
<input type="checkbox" name="foo" value="1" @checked($value === 1) />
```

### 11. `@selected`

Ceci :

```blade
<select name="country">
	@foreach ($countries as $country)
		<option value="{{ $country }} @if ($country === $user->country) selected @endif>
			{{ $country }}
		</option>
	@endforeach
</select>
```

Devient cela :

```blade
<select name="country">
	@foreach ($countries as $country)
		<option value="{{ $country }} @selected($country === $user->country)>
			{{ $country }}
		</option>
	@endforeach
</select>
```

## De nouveaux helpers

### 12. `str()`

Plutôt que de faire `Str::of('foo')` dans Laravel 8, vous pouvez maintenant faire :

```php
// On transforme "ha" en "Hahahahaha!"
echo str('ha')
	->repeat(5)
	->headline()
	->append('!');
```

### 13. `to_route()` (également dispo dans Laravel 8)

Plutôt que de faire :

```php
return redirect()->to('foo');
```

On peut désormais faire :

```php
return to_route('foo');
```

Quel intérêt ? C'est tout simplement plus simple à lire.

## Bonus: un nouveau [laravel.com](https://laravel.com)

Il ne s'agit pas d'une nouveauté ayant un vrai rapport avec Laravel 9, mais il est agréable de constater que le site officiel reçoit toute l'attention qu'il mérite. Le design du site a été actualisé et des améliorations ont été faites sur la coloration syntactique des bouts de code.

<figure>
<img src="https://larabiz.fr/storage/17/conversions/48f18889a1a64b511fc01db9aba6fe2846fc9c06-medium.jpg" alt="laravel.com avant." />
<figcaption>Avant.</figcaption>
</figure>

<figure>
<img src="https://larabiz.fr/storage/20/conversions/2670de6252f231496b565a3e4f061af1d20cb4bb-medium.jpg" alt="laravel.com après." />
<figcaption>Après.</figcaption>
</figure>

D'ailleurs, saviez-vous que [laravel.com](https://laravel.com) est open source ? Vous pouvez retrouver le dépôt Git sur [GitHub](https://github.com/laravel/laravel.com).

À vos clavier, je vous donne rendez-vous dans le [guide de mise à jour](https://laravel.com/docs/9.x/upgrade) officiel de Laravel ! 🥳
