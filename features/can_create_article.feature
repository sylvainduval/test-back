# language: fr
Fonctionnalité: Gérer les ressources
  Afin de gérer les ressources intervenant dans la gestion des articles
  En tant que personne ayant des droits de création d'articles
  Je souhaite disposer d'une API Rest

  Scénario: Créer un article
    Lorsque j'ajoute l'entête Content-Type égale à application/ld+json
    Et j'envoie une requête HTTP POST sur articles avec le contenu :
     """
     {
       "title": "Titre",
       "body": "Corps",
       "createdAt": "2021-09-16T14:03:23.768Z",
       "createdBy": "sylvain",
       "leadingTitle": "Accroche"
     }
     """
    Alors le code HTTP de la réponse doit être 201
