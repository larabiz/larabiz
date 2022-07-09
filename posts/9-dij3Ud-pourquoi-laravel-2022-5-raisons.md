<!--
Author: Benjamin Crozat
Image: https://res.cloudinary.com/benjamin-crozat/image/upload/q_auto/f_auto/v1657461037/blog/uKh5vPr2BHWZ53bT9khO63u6SU3p3wMU0jw2sfTq_bvipnm.jpg
Title: Pourquoi utiliser Laravel en 2022 ? Voici 5 raisons.
Excerpt: Débuter en PHP n'est pas évident. L'écosystème est énorme et il est difficile de se décider sur un framework. Découvrez pourquoi choisir Laravel en 2022.
Certified for Laravel Version: 9
-->

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
