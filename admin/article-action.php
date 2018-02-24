<?php
require_once 'partials/header.php';

//echo debug($_FILES);

$action = !empty($_GET['action']) ? $_GET['action'] : 'insert';
$id = !empty($_GET['id']) ? intval($_GET['id']) : 0;

if (!empty($id)) {

	$query = $db->prepare('SELECT * FROM articles WHERE id = :id');
	$query->bindValue(':id', $id, PDO::PARAM_INT);
	$query->execute();
	$article = $query->fetch();

	if (!empty($article) && $action == 'delete') {

		$query = $db->prepare('DELETE FROM articles WHERE id = :id');
		$query->bindValue(':id', $id, PDO::PARAM_INT);
		$query->execute();

		if ($query->rowCount() > 0) {
			echo '<div class="alert alert-success">Suppression réussie</div>';
			echo redirectJS('articles.php');
		} else {
			echo '<div class="alert alert-danger">Echec suppression</div>';
		}
		exit();
	}
}

if ($action == 'update' && empty($article)) {
	exit('Undefined article');
}

// Récupérer les données du formulaire depuis le tableau $_POST
$name = isset($_POST['name']) ? strip_tags($_POST['name']) : @$article['name'];
$content = isset($_POST['content']) ? strip_tags($_POST['content']) : @$article['content'];
$picture = isset($_FILES['picture']['name']) ? $_FILES['picture']['name'] : @$article['picture'];
$creation_date = isset($_POST['creation_date']) ? strip_tags($_POST['creation_date']) : @$article['creation_date'];

if (empty($creation_date) || strtotime($creation_date) === false) {
	$creation_date = date('Y-m-d H:i:s');
}

// On défini le poids maximum autorisé pour l'upload de fichier
$max_file_size = 2000000; // ~2Mo


// Initialiser un tableau $errors et une chaine $result
$errors = array();
$result = '';

// Le formulaire a été soumis, l'utilisateur a appuyé sur Envoyer
if (!empty($_POST)) {

	// Vérifier que les champs obligatoires ne sont pas vides
	// Pour chaque erreur rencontrée, ajouter une entrée dans le tableau $errors correspondant au champ en erreur
	if (empty($name) || strlen($name) > 100) {
		$errors['name'] = 'Le nom est invalide (longueur max 100)';
	}
	if (empty($content) || strlen($content) < 20 || strlen($content) > 255) {
		$errors['content'] = 'Le contenu de la JDC est invalide (longueur min 20, longueur max 255)';
	}

	// S'il n'y a pas d'erreur on lance la requête d'insertion
	if (empty($errors)) {

		// Si on a un fichier uploadé
		if (!empty($picture)) {

			// S'il n'y a pas d'erreur
			if (empty($_FILES['picture']['error']) &&
				$_FILES['picture']['size'] < $max_file_size) {
			//if ($_FILES['picture']['error'] === UPLOAD_ERR_OK) {

				$picture_mime_type = image_type_to_mime_type(exif_imagetype($_FILES['picture']['tmp_name']));

				switch($picture_mime_type) {
					case 'image/png':
					case 'image/jpeg':
					case 'image/gif':
						move_uploaded_file($_FILES['picture']['tmp_name'], '../img/'.$picture);
					break;
					default:
						$errors['picture'] = 'Format de fichier non autorisé';
					break;
				}

			} else {
				$errors['picture'] = 'Erreur upload image';
			}
		}

		if (empty($errors)) {

			if ($action == 'update') {
				$query = $db->prepare('UPDATE articles SET name = :name, content = :content, picture = :picture, creation_date = :creation_date WHERE id = :id');
				$query->bindValue(':id', $id, PDO::PARAM_INT);
			} else {
				$query = $db->prepare('INSERT INTO articles SET name = :name, content = :content, picture = :picture, creation_date = :creation_date');
			}

			$query->bindValue(':name', $name, PDO::PARAM_STR);
			$query->bindValue(':content', $content, PDO::PARAM_STR);
			$query->bindValue(':picture', $picture, PDO::PARAM_STR);
			$query->bindValue(':creation_date', $creation_date, PDO::PARAM_STR);
			$query->execute();

			if ($action == 'update') {
				$success = $query->rowCount();
				$success_msg = 'Mise à jour réussie';
			} else {
				// On récupère l'identifiant unique automatiquement généré par la requête
				$success = $db->lastInsertId();
				$success_msg = 'Insertion réussie';
			}
			//Si la requête a réussie (c.f. lastInsertId()), on affiche une confirmation à l'utilisateur
			if (!empty($success)) {
				$result .= '<div class="alert alert-success">'.$success_msg.'</div>';
				$result .= redirectJS('articles.php');
			} else {
				$result .= '<div class="alert alert-danger">Une erreur s\'est produite, merci de réessayer ultèrieurement</div>';
			}
		}
	}
}

?>
	<h1><?= ucfirst($action) ?> article</h1>
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
	<!-- L'attribut enctype="multipart/form-data" permet de gérer l'upload de fichier -->
	<form method="POST" enctype="multipart/form-data">

		<input type="hidden" name="MAX_FILE_SIZE" value="<?= $max_file_size ?>" />

		<div class="form-group">
			<label for="name">Nom</label>
			<input type="text" class="form-control" name="name" id="name" placeholder="Auteur" value="<?= $name ?>">
		</div>

		<div class="form-group">
			<label for="content">Contenu</label>
			<textarea name="content" id="content" class="form-control" rows="5" placeholder="Contenu la JDC"><?= $content ?></textarea>
		</div>

		<div class="form-group">
			<label for="picture">Image</label>
			<input type="file" class="form-control" name="picture" id="picture" placeholder="Image">
		</div>

		<div class="form-group">
			<label for="creation_date">Date</label>
			<input type="date" class="form-control" name="creation_date" id="creation_date" placeholder="Date de la JDC" value="<?= $creation_date ?>">
		</div>

		<button type="submit" class="btn btn-default">Envoyer</button>
	</form>
	<?php } ?>

<?php require_once 'partials/footer.php' ?>