<!--
Author: Benjamin Crozat
Image: https://res.cloudinary.com/benjamin-crozat/image/upload/q_auto/f_auto/v1657461035/blog/2bNSUy4X0IKUbtaqtTO5Nuj4GSYC9prgWwaGXOMe_ztdwul.jpg
Title: Laravel VS. Lumen en 2022 : lequel utiliser pour des performances optimales ?
Excerpt: Avec le temps, les choses changent. Les microframeworks n'échappent pas à cette règle et leur pertinence s'amoindrit. Découvrez pourquoi avec Laravel et Lumen.
Certified for Laravel Version: 9
-->

## Lumen n'est plus activement maintenu

Récemment, le fichier README de Lumen a été mis à jour avec [ce message](https://github.com/laravel/lumen/commit/69b26578d2f15595ea901278434b74df459c4329) (traduit par mes soins) :

> Depuis la sortie de [Lumen](https://lumen.laravel.com), PHP a bénéficié d'une multitude d'améliorations en termes de performances. Pour cette raison, en plus de la disponibilité de [Laravel Octane](https://laravel.com/docs/octane), nous ne recommandons plus de commencer de nouveaux projets avec Lumen. Nous recommandons plutôt [Laravel](https://laravel.com)._

Le message est clair : **ne perdez pas votre temps avec Lumen**. Mais laissez-moi tout de même continuer l'argumentation.

## Le manque de fonctionnalités fait perdre en productivité

Afin d'atteindre ses objectifs en termes de performances, Lumen est débarrassé de tout un tas de fonctionnalités. Certaines ne vous manqueront pas, mais vous pleurerez le départ de celles que vous étiez habitué à utiliser avec Laravel.

## Il y a peu de différence sur un vrai projet en termes de performances

On trouve tout un tas de benchmarks sur le web, comme [celui-ci](https://igliop.medium.com/benchmarking-serverless-laravel-vs-lumen-with-bref-c3bdca37e5b8) ou [celui-là](https://medium.com/@jeffalmeida_27473/laravel-vs-lumen-what-should-i-use-63c196822b2d), et ils en viennent tous à la même conclusion : dans le contexte d'un vrai projet, la différence est quasiment imperceptible.

## Laravel est plus rapide que Lumen grâce à Octane

Le principe est simple (sur le papier) : Octane garde en mémoire le processus de bootstrapping de Laravel. Ainsi, à chaque requête, seul votre code est exécuté. Cela se traduit la plupart du temps en des gains de performances de l'ordre de 50% (exemple [ici](https://moduscreate.com/blog/boost-your-laravel-project-performance-with-octane/) ou [là](https://medium.com/geekculture/speed-up-your-laravel-projects-using-laravel-octane-swoole-server-a39f4a7fa889)). Ceci dit, il faut garder à l'esprit qu'un projet avec Octane a ses particularités et il y a quelques dispositions à prendre au niveau de votre code. Mais si vous êtes intéressés, je vous laisse consulter la [documentation](https://laravel.com/docs/octane).

## Conclusion

Pour des performances et une productivité accrues, utilisez Laravel + Octane. Lumen a fait son temps et le moment est venu pour lui de prendre sa retraite.
