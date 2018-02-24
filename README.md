Les Joies Du Code
=============

#### *** DESCRIPTION *** ####

Connexion / inscription / déconnexion

#### *** RAPPEL *** ####

En PHP, pour réceptionner des données en POST depuis un formulaire, il faut réunir 3 conditions :

1. Les champs de formulaire doivent être placés au sein d'une balise ``<form></form>``, la balise form est en envoyé en GET par défaut, il faut préciser ``method="POST"`` pour que le formulaire soit soumis en POST
2. Les champs de formulaire (input, textarea, select..etc) doivent avoir un attribut ``name``
3. Il faut un button ou un input type submit pour envoyer le formulaire

#### *** CONSIGNES *** ####

1. ``Créer la table "user" avec les champs : id, firstname, lastname, gender, email, password, newsletter, register_date``

2. ``Sur la page register.php, récupérer puis contrôler les données du formulaire.``
``Si pas d'erreurs, crypter le mot de passe et faire la requête d'insertion dans la table "user"``

2. ``Sur la page login.php, récupérer puis contrôler les données du formulaire.``
``Si pas d'erreurs, faire une requête qui va chercher un user pour l'email saisi par l'utilisateur.``
``Si l'email est trouvé, comparer le mot de passe crypté avec le mot de passe saisi par l'utilisateur.``
``Si les mots de passe correspondent, ajouter l'id, le prénom et le nom du user en session, puis rediriger vers la page d'accueil``

4. ``Dans navbar.php, à l'emplacement des liens Connexion/Inscription, si l'utilisateur est connecté, afficher Bonjour prénom nom, sinon afficher les liens``

5. ``Dans send.php, vérifier si l'utilisateur est bien connecté (user id en session), sinon redirection vers login.php``

6. ``Créer un fichier logout.php qui déconnecte l'utilisateur, puis redirige vers la page d'accueil``

7. ``Dans navbar.php, afficher après Bonjour prénom nom, un lien vers la page de déconnexion``

#### *** BONUS *** ####

- ``Au login, gérer la case à cocher Se souvenir de moi``
