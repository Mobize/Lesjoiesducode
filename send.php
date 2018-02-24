<?php
include_once 'header.php';

if (!empty($_POST)) {

	$name = !empty($_POST['name']) ? strip_tags($_POST['name']) : '';
	$content = !empty($_POST['content']) ? $_POST['content'] : '';

	$errors = array();
	if (empty($name)) {
		$errors['name'] = 'Le nom est vide';
	}
	if (empty($content) || strlen($content) < 10) {
		$errors['content'] = 'Vous devez écrire au moins 10 caractères';
	}

	if (empty($errors)) {

		$query = $db->prepare('INSERT INTO posts (name, content, creation_date) VALUES (:name, :content, :creation_date)');

		$query->bindValue('name', $name, PDO::PARAM_STR);
		$query->bindValue('content', $content, PDO::PARAM_STR);
		$query->bindValue('creation_date', date('Y-m-d H:i:s'), PDO::PARAM_STR);

		$query->execute();

		$insert_id = $db->lastInsertId();

		if (!empty($insert_id)) {
			echo '<h1>Envoyez votre Joie du code</h1>';
			echo '<hr>';
			echo 'Votre Joie du code a bien été envoyée !<br><br>';
			echo '<a href="post.php?id='.$insert_id.'">Consulter votre Joie du code</a>';
			exit();
		}
	}
}
?>
	<h1>Envoyez votre Joie du code</h1>

	<hr>

	<?php if (!empty($errors)) { ?>
	<div class="alert alert-danger" role="alert">
	Le formulaire comporte des erreurs :
	<?php foreach($errors as $field => $error) { ?>
	- <?= $error ?>
	<?php } ?>
	</div>
	<?php } ?>

	<form action="send.php" method="POST">
		<div class="form-group">
			<label for="name">Votre nom</label>
			<input type="text" class="form-control" name="name" id="name" placeholder="Entrez votre nom">
		</div>
		<div class="form-group">
			<label for="content">Votre Joie de code</label>
			<textarea name="content" id="content" class="form-control" rows="5" placeholder="Contenu de votre Joie de code"></textarea>
		</div>
		<button type="submit" class="btn btn-default">Submit</button>
	</form>

<?php include_once 'footer.php'; ?>