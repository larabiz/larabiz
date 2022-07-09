<!--
Author: Benjamin Crozat
Image: https://res.cloudinary.com/benjamin-crozat/image/upload/q_auto/f_auto/v1657461036/blog/FIhHrH9SzaWHnvfG4V4a2WuZlX5h5QtJsYCfID5U_n4asju.jpg
Title: Comment créer un modèle, une migration et plus encore avec Artisan
Excerpt: Créer les fichiers et le code de base pour chaque modèle Eloquent peut rapidement devenir répétitif. Heureusement, Artisan vient à notre rescousse.
Certified for Laravel Version: 9
-->

## Créer un modèle avec Artisan

Ici, rien de farfelu. Cette commande vous permettra de générer un modèle "Post" que vous retrouverez dans le dossier *app/Models*.

```bash
php artisan make:model Post
```

## Créer un modèle accompagné d'une migration

Savez-vous qu'il est aussi possible de générer une migration correspondant au modèle ?

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
