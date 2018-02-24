<?php
require_once 'partials/header.php';

if (!userIsLogged()) {
	header('Location: login.php');
	exit();
}
//print_r($_POST);

// Récupérer les données du formulaire depuis le tableau $_POST
$name = !empty($_POST['name']) ? strip_tags($_POST['name']) : '';
$content = !empty($_POST['content']) ? strip_tags($_POST['content']) : '';

// Initialiser un tableau $errors et une chaine $result
$errors = array();
$result = '';

// Le formulaire a été soumis, l'utilisateur a appuyé sur Envoyer
if (!empty($_POST)) {

	// Vérifier que les champs obligatoires ne sont pas vides
	// Pour chaque erreur rencontrée, ajouter une entrée dans le tableau $errors correspondant au champ en erreur
	if (empty($name) || strlen($name) > 100) {
		$errors['name'] = 'Ton nom est invalide (longueur max 100)';
	}
	if (empty($content) || strlen($content) < 20 || strlen($content) > 255) {
		$errors['content'] = 'Le contenu de ta JDC est invalide (longueur min 20, longueur max 255)';
	}

	// S'il n'y a pas d'erreur on lance la requête d'insertion
	if (empty($errors)) {

		$query = $db->prepare('INSERT INTO articles SET name = :name, content = :content, creation_date = NOW()');
		$query->bindValue(':name', $name, PDO::PARAM_STR);
		$query->bindValue(':content', $content, PDO::PARAM_STR);
		$query->execute();

		// On récupère l'identifiant unique automatiquement généré par la requête
		$insert_id = $db->lastInsertId();

		//Si la requête a réussie (c.f. lastInsertId()), on affiche une confirmation à l'utilisateur
		if (!empty($insert_id)) {
			$result .= '<div class="alert alert-success">Votre message a bien été envoyé</div>';
			$result .= redirectJs('article.php?id='.$insert_id, 3);
		} else {
			$result .= '<div class="alert alert-danger">Une erreur s\'est produite, merci de réessayer ultèrieurement</div>';
		}
	}
}
?>
		<h1>Envoyez votre Joie du code</h1>
		<hr>

		<?php if (!empty($errors)) { ?>
		<div class="alert alert-danger">
			<ul>
			<?php
			foreach($errors as $error) {
				echo '<li>'.$error.'</li>';
			}
			?>
			</ul>
		</div>
		<?php } ?>

		<?php
		if (!empty($result)) {
			echo $result;
		} else {
		?>
		<form action="send.php" method="POST">
			<div class="form-group">
				<label for="name">Votre nom</label>
				<input type="text" class="form-control" name="name" id="name" placeholder="Entrez votre nom" value="<?= $name ?>">
			</div>
			<div class="form-group">
				<label for="content">Votre Joie de code</label>
				<textarea name="content" id="content" class="form-control" rows="5" placeholder="Contenu de votre Joie de code"><?= $content ?></textarea>
			</div>
			<button type="submit" class="btn btn-default">Envoyer</button>
		</form>
		<?php } ?>

<?php require_once 'partials/footer.php' ?>