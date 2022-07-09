<!--
Author: Benjamin Crozat
Image: https://res.cloudinary.com/benjamin-crozat/image/upload/q_auto/f_auto/v1657461035/blog/e10e48cd9bd3cc3c461da73b6f0b0d11ef66eb18_aqbmqc.jpg
Title: Avant d'utiliser le système de files d'attente de Laravel, essayez dispatchAfterResponse()
Excerpt: Il est primordial dans votre carrière que vous appreniez à ne pas déployer des solutions trop sophistiquées pour des besoins modestes. Laravel en est conscient et propose des solutions.
Certified for Laravel Version: 9
-->

Les files d'attentes sur Laravel (ou queues) permettent d'exécuter des tâches chronophages en arrière-plan sans faire attendre vos visiteurs devant un écran de chargement.

Cependant, il y a certaines tâches, comme l'envoi d'un simple e-mail, qui ne devraient pas avoir besoin d'une telle infrastructure. L'idéal serait de pouvoir afficher votre page sur le navigateur de l'utilisateur et ensuite déclencher l'envoi de l'e-mail.

Prenons un formulaire d'abonnement à une newsletter comme exemple :

- L'utilisateur valide son intention de s'abonner en cliquant sur le bouton "M'abonner" après avoir entré son adresse ;
- Il est quasi-instantanément redirigé vers une page lui demandant surveiller sa boîte de réception pour l'e-mail de confirmation ;
- L'envoi de l'e-mail est déclenché juste après, ce qui permet de ne pas avoir une latence d'une à deux secondes avant d'afficher la page mentionnée à l'étape précédente.

Comment arrive-t-on a un tel résultat sans utiliser les queues ? Tout simplement en utilisant la méthode `dispatchAfterResponse()ˋ.

Imaginons notre contrôleur :

```php
public function store(StoreSubscriberRequest $request)
{
    // 1. On crée notre subscriber non-confirmé.
    Subscriber::create($request->validated());
 
    // 3. On envoie l'e-mail de confirmation.
    dispatch(function () {
        //
    })->afterResponse();
    // Ou :
    // MonJobPasTropLongAExecuter::dispatchAfterResponse();
 
    // 2. On redirige l'utilisateur vers la page lui demandant de vérifier sa boite mail pour la confirmation.
    return to_route('pending-subscription');
}
```

Précisons que ce code n'aura l'effet désiré que si vous utilisez PHP-FPM. (Ce qui est probablement le cas pour 99% d'entre-vous.)

Bien sûr, il s'agit d'une feature à utiliser avec parcimonie et seulement pour des tâches courtes, car il y a peu de chances que vous saturiez votre serveur de cette manière.

Pour des besoins plus avancés, utiliser le système de queues de Laravel vous permettra d'exécuter les tâches au compte-gouttes et avec un parallélisme approprié à la configuration de votre machine afin de ne pas y mettre le feu.
