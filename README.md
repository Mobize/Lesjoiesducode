Les Joies Du Code
=============

----------
DESCRIPTION
-------

Les Joies Du Code version VDM.

----------
CONSEILS ET ASTUCES
-------

- Penser à la balise container lors de la découpe
- Identifier et localiser les blocs HTML à l'aide de l'inspecteur d'élément dans le navigateur
- Penser à réduire les balises dans l'éditeur de texte pour visualiser rapidement les blocs (flèches dans la colonne de gauche dans Sublime Text)
- Au besoin commenter les fermetures de balise sur les gros blocs
- Pour les boucles foreach, penser au pluriel/singulier :
```
// Pour chacun DES items, je reçois UN item
foreach($items as $key => $item) {
	echo $item['info'];
}
```
- Afficher régulièrement le contenu des variables qui passent dans les boucles
- Les liens ```<a href="">``` transmettent des paramètres accessibles via le tableau superglobal [\$_GET](http://webforce3.altervista.org/wiki/index.php?title=$_GET)
- Les données d'un formulaire soumis en method POST sont accessibles via le tableau superglobal [\$_POST](http://webforce3.altervista.org/wiki/index.php?title=$_POST)
- Les informations d'environnement du script courant sont accessibles via le tableau superglobal [\$_SERVER](http://webforce3.altervista.org/wiki/index.php?title=$_SERVER)
- *Think [DRY](https://fr.wikipedia.org/wiki/Ne_vous_r%C3%A9p%C3%A9tez_pas)*

----------
CONSIGNES
-------

1. Faire la découpe des templates HTML.
> **CONSEIL** :
> Commencer par copier les fichiers ``.html`` dans un répertoire, puis renommer chaque fichier en ``.php``.
> Placer les fragments de code html (header, footer, navbar,...etc) dans un sous répertoire ``partials``.

2. Isoler la sidebar dans un partial ``sidebar.php``

3. Afficher l'année courante dans le footer en PHP

4. Créer les fichiers ``config - db - func`` dans un répertoire ``inc``
> **CONSEIL :** Reprendre les fichiers d'un projet précédent et adapter au nouveau projet

5. Dans le fichier ``inc/config.php``, créer un tableau ``$pages`` contenant la liste des pages du site avec : en clé le libellé du lien dans le menu, et en valeur le nom du fichier php cible.
> **ASTUCE** : Aligner les balises ``li`` du menu de navigation et utiliser le mode colonne de Sublime Text pour créer le tableau ``$pages``

6. Reconstituer le menu de navigation à partir d'une boucle foreach et du tableau ``$pages`` créé précedemment

7. Créer la base de données ``joiesducode`` avec un encodage ``utf8_general_ci``

8. Créer la table ``post`` avec les champs :
	- id
	- author
	- title
	- content
	- rating
	- creation_date
	- status TINYINT(1)

9. Insérer 50 posts dans la table ``post`` avec du contenu aléatoire (à la main ou en bonus via un script automatique)

10. Dans le fichier ``index.php``, faire une requête qui va chercher les 10 derniers posts, puis les afficher
> **BONUS :** Créer une fonction displayPost($post) pour afficher chaque post
> ** SUPER BONUS :** Implémenter un système de pagination sur l'ensemble des posts, et afficher 4 posts par page

11. Si le post est plus long que 100 caractères, ne garder que les 100 premiers caractères et afficher un lien ``Lire la suite`` qui pointe vers le fichier ``post.php`` en lui transmettant l'identifiant du post

12. Dans le fichier ``post.php``, réceptionner et contrôler l'identifiant du post, faire la requête qui va chercher le post correspondant à l'identifiant, et afficher le post au complet en gérant les sauts de ligne (http://php.net/nl2br)

13. Dans le fichier ``sidebar.php``, faire une requête et une boucle foreach pour remplir les différents encarts (Les 5 posts les plus récents, les 5 posts les mieux notés, 5 posts au hasard)
> **BONUS :** Faire une fonction displayList() pour afficher les encarts

14. Dans le fichier ``send.php``, réceptionner et contrôler les données du formulaire, puis faire une requête qui insert un article en base de données. En cas de succès, afficher un message de confirmation, sinon afficher les erreurs
> **BONUS :** Ajouter au message de confirmation, un lien vers le post nouvellement créé.
> **SUPER BONUS :**
> Faire en sorte de se prémunir des failles/injections XSS (c.f. http://php.net/strip_tags, http://php.net/htmlspecialchars).
> Autoriser les balises : &lt;b&gt; &lt;strong&gt; &lt;i&gt; &lt;em&gt;

----------
POUR LE FUN :gift:
-------

Des thèmes de couleur sont disponibles :
```
$themes = array(
	'amelia' => '3.1.1/css/amelia',
	'cerulean' => '3.6.6/cerulean',
	'cosmo' => '3.6.6/cosmo',
	'cupid' => '3.1.1/css/cupid',
	'custom' => '3.1.1/css/custom',
	'cyborg' => '3.6.6/cyborg',
	'darkly' => '3.6.6/darkly',
	'flatly' => '3.6.6/flatly',
	'journal' => '3.6.6/journal',
	'lumen' => '3.6.6/lumen',
	'paper' => '3.6.6/paper',
	'readable' => '3.6.6/readable',
	'sandstone' => '3.6.6/sandstone',
	'simplex' => '3.6.6/simplex',
	'slate' => '3.6.6/slate',
	'spacelab' => '3.6.6/spacelab',
	'superhero' => '3.6.6/superhero',
	'united' => '3.6.6/united',
	'yeti' => '3.6.6/yeti',
);

$current_theme = 'cerulean';
```

Pour changer de thème il faut remplacer dans le header, les lignes suivantes :
```
<!-- Theme -->
<link href="[...]/bootstrap.min.css" rel="stylesheet" title="theme">
```

Par :
```
<!-- Theme -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/<?= $themes[$current_theme] ?>/bootstrap.min.css" rel="stylesheet" title="theme">
```

----------

> chaq raD !