# lesjoiesducode

Les Joies Du Code
=============

#### *** DESCRIPTION *** ####

Les Joies Du Code version VDM

#### *** CONSIGNES *** ####

1. Créer la base de données "joiesducode" avec un encodage "utf8_general_ci"

2. Créer la table "posts" avec les champs :	id, name, content, creation_date

3. Rendre dynamique la date dans le footer

4. Créer un fichier db.php contenant la connexion PDO

5. Dans index.php, faire une requête qui va chercher les 10 derniers posts
   Puis les afficher

6. Dans random.php, faire une requête qui va chercher un post au hasard
   Puis l'afficher

7. Dans search.php, faire une requête qui va chercher un post qui contient ce qu'on a tapé dans le champ de recherche
   Puis afficher le nombre et la liste des résultats

8. Dans send.php, faire une requête qui insert un post dans la base
   Puis afficher un message de confirmation

#### *** BONUS *** ####

1. Partout où on affiche un post, si le post est plus long que 100 caractères, ne garder que les 100 premiers caractères et afficher un lien qui pointe vers le post complet

2. Créer un fichier post.php qui affiche le post complet

3. Dans send.php, ajouter au message de confirmation un lien vers le post nouvellement créé