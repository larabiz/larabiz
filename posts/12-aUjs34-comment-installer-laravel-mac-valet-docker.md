<!--
Author: Benjamin Crozat
Image: https://res.cloudinary.com/benjamin-crozat/image/upload/q_auto/f_auto/v1657461036/blog/LTFRCPtx77VN3JzU0fU5pKDsTqG8dbk1DdK82Yzw_f49lf8.jpg
Title: Comment installer Laravel sur Mac sans avoir recours à Docker grâce à Valet
Excerpt: Laravel Valet permet de déployer un environnement de développement sur votre machine en moins de temps qu'il n'en faut pour le dire. Découvrez comment faire.
Certified for Laravel Version: 9
-->

Étant partisan du pragmatisme et ayant beaucoup de mal à supporter les contraintes d'un environnement basé sur Docker, je prêche régulièrement les bienfaits de [Laravel Valet](https://laravel.com/docs/valet). Cet outil officiel vous permet de mettre en place un environnement de développement Laravel (voir même Symfony ou WordPress) d'un simple claquement de doigts. En fonction de la vitesse de votre connexion internet et de votre machine, cela peut être réglé en l'espace de￼ 5 minutes. 

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
