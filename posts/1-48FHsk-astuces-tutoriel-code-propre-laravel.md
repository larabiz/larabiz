<!--
Author: Benjamin Crozat
Image: https://res.cloudinary.com/benjamin-crozat/image/upload/q_auto/f_auto/v1657461038/blog/ZjfzeaNKpYWkZpl3VBeeYUzAXHIbXemFHnnWADUk_eok5hw.jpg
Title: 4 astuces pour un code propre et solide sur le long terme
Excerpt: Pouvoir revenir sur un projet après des mois sans y avoir touché est un avantage. Découvrez quelques astuces pour ne plus être totalement perdu.
Certified for Laravel Version: 9
-->

*Il est tellement facile de laisser un projet moisir au fond du tiroir une fois qu'il est déployé en production.*

*Mais un beau jour, votre client finira par revenir vers vous. Il voudra faire évoluer son projet. Malheureusement, votre code est devenu incompréhensible et il est devenu très simple de provoquer des régressions. C'est normal, rares sont ceux qui possèdent une mémoire infaillible. La livraison devient un enfer et vous n'avez qu'une seule envie : faire subir à votre client les pires châtiments imaginables.*

*Attention cependant : ce n'est pas la faute de votre client si la situation a échappé à votre contrôle.*

*Voyons ensemble ce que vous pouvez faire dès maintenant pour changer ça.*

### Utilisez des packages open source

Croyez-en mon expérience : utiliser du code testé et éprouvé par la communauté donnera presque toujours de bien meilleurs résultats que ce que vous aurez vous-même pondu. Pourquoi ?

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

L'avantage d'avoir fait tout ça ? Vos collaborateurs aussi pourront en profiter.

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

Ça coule de source, non ? Ce code n'a absolument pas besoin d'être commenté.

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
