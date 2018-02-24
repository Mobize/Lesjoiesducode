<?php
require_once 'partials/header.php';

//echo debug($_FILES);

$action = !empty($_GET['action']) ? $_GET['action'] : 'insert';
$id = !empty($_GET['id']) ? intval($_GET['id']) : 0;

if (!empty($id)) {

	$query = $db->prepare('SELECT * FROM users WHERE id = :id');
	$query->bindValue(':id', $id, PDO::PARAM_INT);
	$query->execute();
	$user = $query->fetch();

	if (!empty($user) && $action == 'delete') {

		$query = $db->prepare('DELETE FROM users WHERE id = :id');
		$query->bindValue(':id', $id, PDO::PARAM_INT);
		$query->execute();

		if ($query->rowCount() > 0) {
			echo '<div class="alert alert-success">Suppression réussie</div>';
			echo redirectJS('users.php');
		} else {
			echo '<div class="alert alert-danger">Echec suppression</div>';
		}
		exit();
	}
}

if ($action == 'update' && empty($user)) {
	exit('Undefined user');
}

// Récupérer les données du formulaire depuis le tableau $_POST
$firstname = isset($_POST['firstname']) ? strip_tags($_POST['firstname']) :  @$user['firstname'];
$lastname = isset($_POST['lastname']) ? strip_tags($_POST['lastname']) :  @$user['lastname'];
$gender = isset($_POST['gender']) ? intval($_POST['gender']) : array_search(@$user['gender'], $genders);
$email = isset($_POST['email']) ? strip_tags($_POST['email']) :  @$user['email'];
$newsletter = isset($_POST['newsletter']) ? intval($_POST['newsletter']) : @$user['newsletter'];
$role = isset($_POST['role']) ? intval($_POST['role']) : @$user['role'];

// Initialiser un tableau $errors et une chaine $result
$errors = array();
$result = '';

// Le formulaire a été soumis, l'utilisateur a appuyé sur Envoyer
if (!empty($_POST)) {

	// Vérifier que les champs obligatoires ne sont pas vides
	// Pour chaque erreur rencontrée, ajouter une entrée dans le tableau $errors correspondant au champ en erreur
	if (empty($firstname) || strlen($firstname) > 100) {
		$errors['firstname'] = 'Vous devez renseigner un prénom valide';
	}
	if (empty($lastname) || strlen($lastname) > 100) {
		$errors['lastname'] = 'Vous devez renseigner un nom valide';
	}
	if (empty($gender)) {
		$errors['gender'] = 'Vous devez renseigner un gender valide';
	}
	if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = 'Vous devez renseigner un email valide';
	}

	// S'il n'y a pas d'erreur on lance la requête d'insertion
	if (empty($errors)) {

		// On va chercher un user corrspondant à l'email saisi
		$query = $db->prepare('SELECT id FROM users WHERE email  = :email');
		$query->bindValue(':email', $email, PDO::PARAM_STR);
		$query->execute();
		$user = $query->fetch();

		if (!empty($user)) {

			// Si on ajoute un utilisateur avec un email déjà pris
			// OU que je tente de modifier l'email de mon user par un email déjà pris
			if ($action == 'insert' || $id != $user['id']) {
				$errors['email'] = 'Cet email est déjà pris';
			}
		}

		if (empty($errors)) {

			if ($action == 'update') {
				$query = $db->prepare('UPDATE users SET firstname = :firstname, lastname = :lastname, gender = :gender, email = :email, password = :password, newsletter = :newsletter, role = :role, mdate = NOW() WHERE id = :id');
				$query->bindValue(':id', $id, PDO::PARAM_INT);
			} else {
				$query = $db->prepare('INSERT INTO users SET firstname = :firstname, lastname = :lastname, gender = :gender, email = :email, password = :password, newsletter = :newsletter, role = :role, cdate = NOW()');
			}

			$query->bindValue(':firstname', $firstname, PDO::PARAM_STR);
			$query->bindValue(':lastname', $lastname, PDO::PARAM_STR);
			$query->bindValue(':gender', $gender, PDO::PARAM_INT);
			$query->bindValue(':email', $email, PDO::PARAM_STR);
			$query->bindValue(':newsletter', $newsletter, PDO::PARAM_INT);
			$query->bindValue(':role', $role, PDO::PARAM_INT);
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
				$result .= '<div class="alert alert-success">Inscription réussie</div>';
				$result .= redirectJs('users.php');
			} else {
				$result .= '<div class="alert alert-danger">Une erreur s\'est produite, merci de réessayer ultèrieurement</div>';
			}
		}

	}
}

?>
	<h1><?= ucfirst($action) ?> user</h1>
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
	<form method="POST" novalidate>

			<div class="form-group">
				<label for="firstname">Prénom</label>
				<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Votre prénom" value="<?= $firstname ?>" autofocus>
			</div>

			<div class="form-group">
				<label for="lastname">Nom</label>
				<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Votre nom" value="<?= $lastname ?>">
			</div>

			<div class="form-group">
				<label for="gender">Sexe</label>
				<br>

				<?php
				foreach($genders as $gender_value => $gender_label) {
					$checked = $gender_value == $gender ? ' checked' : '';
				?>
				<label class="radio-inline">
					<input type="radio" name="gender" value="<?= $gender_value ?>"<?= $checked ?>> <?= $gender_label ?>
				</label>
				<?php } ?>

			</div>

			<div class="form-group">
				<label for="email">Adresse email</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Un email valide" value="<?= $email ?>">
			</div>

			<div class="form-group">
				<label for="role">Role</label>
				<br>
				<select name="role" id="role">
				<?php
				foreach($role_labels as $role_value => $role_label) {
					$selected = $role_value == $role ? ' selected' : '';
				?>
					<option value="<?= $role_value ?>"<?= $selected ?>><?= $role_label ?></option>
				<?php } ?>
				</select>
			</div>

			<div class="checkbox">
				<label>
					<input name="newsletter" id="newsletter" type="checkbox" value="1"<?= ($newsletter ? ' checked' : '') ?>> Inscription à la newsletter
				</label>
			</div>
			<br>

			<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Envoyer</button>

		</form><!-- /form -->
	<?php } ?>

<?php require_once 'partials/footer.php' ?>