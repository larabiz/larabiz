<!--
Author: Benjamin Crozat
Image: https://res.cloudinary.com/benjamin-crozat/image/upload/q_auto/f_auto/v1657461035/blog/dCDJlO9L6vf1UXHjt5qkx03TmQJRW81pkYA2MedJ_ev156t.jpg
Title: Comment installer Bootstrap 5 dans un projet Laravel
Excerpt: Bootstrap est l'outil le plus populaire pour concevoir des interfaces travaillées en un clin d'œil. Intégrons-le dans Laravel grâce à Mix.
Certified for Laravel Version: 9
-->

## Installer le package

Plutôt que d'utiliser le CDN de Bootstrap, nous allons utiliser Webpack (à travers Laravel Mix). Cela nous permettra plus tard d'inclure seulement les briques que vous utilisez. Mais nous verrons cela plus tard.  
Pour le moment, exécutez la commande suivante :

```bash
# Ou `yarn add bootstrap @popperjs/core`
npm install bootstrap @popperjs/core
```

## Configuration de Laravel Mix

Laravel Mix est une abstraction autour de Webpack. Si vous avez déjà essayé d'utiliser Webpack, vous apprécierez le gain de temps et d'énergie que cet outil vous fera gagner. Et à mon avis, il serait bête de s'en priver.  
Dans votre fichier `webpack.mix.js`, assurez-vous d'avoir ceci :

```js
mix
    .css('resources/css/app.css', 'public/css')
    .js('resources/js/app.js', 'public/js')
```

## Import

Grâce à Webpack, il est possible d'organiser son code JavaScript en modules, tout comme en PHP avec la fonction `include`. Rendez-vous dans `resources/js/app.js` et ajoutez ceci :

```js
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'
```

Oui, nous appelons un fichier CSS dans du JavaScript ! Mais ne vous inquiétez pas, c'est tout à fait normal. Jetez un œil à votre page, vous verez qu'il sera inclut dans une balise `style`.

## Appel du script dans le HTML

Maintenant que tout est compilé, il vous faut appeler le CSS et le JavaScript sur votre page grâce aux balises `link` et `script` :

```blade
<!DOCTYPE html>
<html>
	<head>
	    …
		
		<link rel="stylesheet" href="{{ mix('/css/app.css') }}" />
	</head>
	<body>
	    …
		
		<script src="{{ mix('/js/app.js') }}"></script>
	</body>
</html>
```

## Compilation

La dernière étape, c'est la compilation. Il nous faut générer les fichiers `public/css/app.css` et `public/js/app.js`. Utilisez la commande ci-dessous :

```bash
# Ou `yarn dev`
npm run dev
```

## Évitez le cache côté navigateur lorsque le code a changé

Afin d'éviter que votre navigateur vous serve une version mise en cache de votre JavaScript et votre CSS, ajoutez ceci à votre `webpack.mix.js`:

```js
mix
	.css('resources/css/app.css', 'public/css')
    .js('resources/js/app.js', 'public/js')
    .version()
```

En coulisse, Laravel Mix se contentera simplement d'ajouter une query string à la fin de l'URL (exemple : `/css/app.css?id=d907e32d5bfb758e04474f878b0216c3`), ce qui sera suffisant pour faire comprendre à votre navigateur que vous avez besoin de code frais.

## Diminuer la taille de notre fichier en important le strict nécessaire

Lors de la compilation, Laravel Mix prend bien soin de minifier votre JavaScript. Combinez ça a de la compression côté serveur, et on obtient un fichier vraiment light. Il est possible d'aller plus loin encore en important seulement les briques nécessaires de Bootstrap.  

Admettons que pour votre site, vous n'utilisez que les alertes et les tooltips. Alors nous changeront notre app.js comme ceci :

```js
import { Alert, Tooltip } from 'bootstrap'
```

C'est terminé, merci de m'avoir lu jusqu'au bout !

Dans le cas où vous préfèreriez un framework CSS moins "couteau Suisse", je vous recommande de vous intéresser à [Tailwind CSS](https://larabiz.fr/blog/comment-tailwind-css-3-laravel).
