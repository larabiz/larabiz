*👆 La table des matières est accessible ici en cliquant sur l'icône à gauche de "README.md" !*

![Banner](https://user-images.githubusercontent.com/3613731/187457146-1bb62d24-19e1-4d94-b7f2-2914f30687d5.jpg)

# Larabiz

Bienvenu dans le code source de [Larabiz](https://larabiz.fr) !

## Avant de commencer

**S'il vous plait, ne passez pas trop de temps à développer de nouvelles fonctionnalités pour Larabiz. Je n'aurai probablement pas le temps de les maintenir. Ce dépôt a surtout un but pédagogique.**

Ce dont Larabiz a besoin (accessoirement, car je n'ai pas réellement besoin d'aide pour le moment) :
- Des corrections de bugs qui gênent votre utilisation du site ;
- Des corrections au niveau du code si vous voyez un oubli ou quelque chose qui pourrait être amélioré "the Laravel-way".

Ce dont Larabiz n'a pas besoin :
- Des grosses features chronophages à passer en revue et maintenir ;
- Des ajustements subjectifs au niveau du style de code ;
- Des design patterns inutilement compliqués ;
- D’autres superstitions de développeurs comme le SRP, le découplage, etc.

## Configuration requise

- PHP
- MySQL
- Redis

## Installation

Partons du principe que vous utilisez Laravel Valet. Si ce n'est pas le cas, je vous demanderai de faire le travail de recherche vous-même et d'adapter les instructions à votre environnement favori.

### Clonage du dépôt Git

```bash
git clone git@github.com:larabiz/larabiz.git
```

Rendez-vous ensuite dans le dossier pour la suite :

```bash
cd larabiz
```

### Installez les dépendances

```bash
composer install
```

### Configuration de l'environnement

Créez un fichier d'environnement à partir de l'exemple et configurez-le à votre sauce :

```bash
cp .env.example .env
```

N'oubliez pas de générer la clé de chiffrement :

```bash
php artisan key:generate
```

### Création et seeding de la base de données

Plutôt que de passer par un client MySQL, vous pouvez tout simplement copier et coller cette commande dans votre terminal :

```bash
mysql -u root -e "CREATE DATABASE larabiz"
```

Afin de travailler correctement en local, il vous faut de la data. Non, nous ne rappatrions rien de la prod. Nous allons simplement faire bon usage des factories et de [Faker](https://github.com/fakerphp/faker).

```bash
php artisan migrate --seed
```

### Rappatriez les Google Fonts

```
php artisan google-fonts:fetch
```

### Compilation du CSS et du JavaScript

Installons les packages Node dont nous avons besoin :

```bash
yarn
```

Maintenant, nous pouvons compiler, faire des changements et les voir répercutés sur le navigateur sans avoir besoin de recharger la page grâce à [Vite](https://vitejs.dev).

```bash
yarn dev
```

## Les tests automatisés

### Organisation

Chaque fichier du dossier *app* possède un test lorsque c'est pertinent.

Parfois, il arrive que je modifie une fonctionnalité fournie par un package. Ces tests là se trouveront dans *tests/App*, faute de mieux.

### Configuration de l'environnement de test

Si pour vos propres besoins, vous avez besoin de modifier une variable d'environnement ou que sais-je d'autre, créez un fichier *phpunit.xml* depuis *phpunit.xml.dist*.

### Création de la base de données

```bash
mysql -u root -e "CREATE DATABASE larabiz_test"
```

### Exécuter les tests

De manière séquentielle :

```bash
php artisan test
```

En parallèle :

```bash
php artisan test --parallel
```

## Déploiement

Une fois votre PR acceptée et mergée sur la branche *main*, les GitHub Actions exécutent les tests. Si ils passent, alors le déploiement est automatiquement déclenché en production. Le meilleur dans tout ça ? Zéro down-time pour les utilisateurs et agilité maximale. 
