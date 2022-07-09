<!--
Author: Benjamin Crozat
Image: https://res.cloudinary.com/benjamin-crozat/image/upload/q_auto/f_auto/v1657461036/blog/o3IbbaKgpgXPTy2m1FxLd1xDogNcVJwHKf62GX8a_jwza5a.jpg
Title: Comment créer un nouveau projet avec Laravel
Excerpt: Saviez-vous qu'il y a un installeur officiel Laravel ? Ou qu'il est possible de passer tout un tas d'options lors de la création d'un nouveau projet ?
Certified for Laravel Version: 9
-->

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
