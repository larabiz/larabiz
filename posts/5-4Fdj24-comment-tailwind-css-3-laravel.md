<!--
Author: Benjamin Crozat
Image: https://res.cloudinary.com/benjamin-crozat/image/upload/q_auto/f_auto/v1657461037/blog/T0vG9RCo11er3DOMV3WFnTgq2tX4rS9hyrowYZMq_seyovi.jpg
Title: Comment installer Tailwind CSS 3 dans un projet Laravel
Excerpt: Tailwind CSS déchaine les passions. Certains l’adorent, certains le détestent. Découvrez comment l’intégrer à votre projet Laravel.
Certified for Laravel Version: 9
-->

[Tailwind CSS](https://tailwindcss.com) est un framework CSS utilisant le concept des classes utilitaires. Il y en a pour quasiment tout et peuvent être combinées ensemble afin de concevoir des interfaces web rapidement sans avoir à vous soucier de l'organisation de vos fichiers ou du nommage de vos classes.

## Installez le package

Installez Tailwind CSS via NPM :

```bash
npm install tailwindcss
```

Le framework dépend de [PostCSS](https://postcss.org). Assurez-vous qu'il est installé également (normalement, toute nouvelle installation de Laravel l'intègre par défaut) :

```bash
npm install postcss --save-dev
```

## Créez le fichier de configuration

Le fichier de configuration de Tailwind vous permettra d'ajouter de nouvelles valeurs au framework et plus encore. C'est une pièce essentielle que vous pouvez créer grâce à la commande suivante :

```bash
npx tailwind init
```

## Configurez Laravel Mix

Dans `webpack.mix.js`, demandez à PostCSS d'utiliser le plugin.

```js
mix.postCss('resources/css/app.css', 'public/css', [
    require('tailwindcss')
])
```

## Ajoutez les directives `@tailwind`

Dans *resources/css/app.css*, nous devons demander à PostCSS d'intégrer tous les styles que génèrera le compilateur Just-in-Time de Tailwind. D'abord les styles de base, ensuite les composants (tel que `.container` par exemple), puis toutes les classes utilitaires que nous connaissons bien.

```css
@tailwind base;
@tailwind components;
@tailwind utilities;
```

## Dites au compilateur JIT où regarder

Maintenant, précisons quels sont les types de fichiers utilisant Tailwind dans `tailwind.config.js`

```js
module.exports = {
    content: [
        "./resources/views/**/*.blade.php",
    ],
  
    …
}
```

## Codez !

Passons enfin au plus intéressant et demandons à Tailwind de surveiller le moindre changement que nous faisons dans les fichiers que nous avons configurés à l'étape précédente :

```bash
npm run watch
```

Enfin, importez le CSS :

```blade
<!DOCTYPE html>
<html>
	<head>
	    …
		
	    <link rel="stylesheet" href="{{ mix('/css/app.css') }}" />
	</head>
	<body>
	    …
	</body>
</html>
```

Puis commencez à styler votre HTML ! Exemple :

```html
<button class="bg-blue-400 font-bold px-4 py-3 rounded text-white">
    Envoyer
</button>
```

## Bonus : évitez les problèmes de cache

Afin d'éviter que votre navigateur vous serve une version mise en cache de votre CSS (que vous soyez en local ou en production), ajoutez ceci dans votre `webpack.mix.js`:

```js
mix.version()
```

En coulisse, Laravel Mix ajoutera une query string à la fin de l'URL de votre feuille de style afin que votre navigateur ne puise pas dans son cache.
