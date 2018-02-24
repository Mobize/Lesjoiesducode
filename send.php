<?php
include_once 'header.php';

$name = '';
$content = '';

if (!empty($_POST)) {

	$name = !empty($_POST['name']) ? strip_tags($_POST['name']) : '';
	$content = !empty($_POST['content']) ? Utils::strip_selected_tags($_POST['content'], array('script')) : '';

	if (empty($name) || empty($content)) {
		echo '<div class="alert alert-danger" role="alert">Le nom et le contenu sont obligatoires !</div>';
	} else {

		$query = $db->prepare('INSERT INTO posts (name, content, creation_date) VALUES (:name, :content, NOW())');

		/*
		// Syntaxe alternative de la requête INSERT INTO
		$query = $db->prepare('INSERT INTO posts SET name = :name, content = :content, creation_date = :creation_date');
		*/

		$query->bindValue('name', $name, PDO::PARAM_STR);
		$query->bindValue('content', $content, PDO::PARAM_STR);
		//$query->bindValue('creation_date', date('Y-m-d H:i:s'), PDO::PARAM_STR);
		$query->execute();

		$insert_id = $db->lastInsertId();
		if (!empty($insert_id)) {
			echo '<div class="alert alert-success" role="alert">Votre Joie du code a bien été ajoutée !</div>';
			echo '<a href="post.php?id='.$insert_id.'">Voir votre Joie du code</a>';
			exit();
		}
	}
}
?>
	<h1>Envoyez votre Joie du code</h1>

	<hr>

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

<?php include_once 'footer.php'; ?>