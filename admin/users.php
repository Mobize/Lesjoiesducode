<?php
require_once 'partials/header.php';

if (!userIsAllowedAccess(USER_ROLE_ADMIN)) {
	header('Location: index.php');
	exit();
}

// Tous les utilisateurs inscrits
$query = $db->query('SELECT * FROM users ORDER BY cdate DESC');
$users = $query->fetchAll();
?>
		<h1>Utilisateurs</h1>
		<hr>

		<a href="user-action.php" class="btn btn-primary">Ajouter un utilisateur</a>
		<hr>

		<table id="table-dynamic" class="table table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>Prénom</th>
					<th>Nom</th>
					<th>Email</th>
					<th>Newsletter</th>
					<th>Role</th>
					<th>Date</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>

				<?php foreach($users as $user) { ?>
				<tr>
					<td><?= $user['id'] ?></td>
					<td><?= ucfirst($user['firstname']) ?></td>
					<td><?= ucfirst($user['lastname']) ?></td>
					<td><a href="mailto:<?= $user['email'] ?>"><?= $user['email'] ?></a></td>
					<td><?= $user['newsletter'] ?></td>
					<td>
						<span class="label label-<?= user_getRoleClass($user['role']) ?>">
							<?= user_getRoleLabel($user['role']) ?>
						</span>
					</td>
					<td><?= getFormatDate($user['cdate'], 'd/m/Y H:i:s') ?></td>
					<td>
						<a href="user-action.php?id=<?= $user['id'] ?>&action=update"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;
						<a href="user-action.php?id=<?= $user['id'] ?>&action=delete" onclick="return confirm('Etes vous sur ??')"><span class="glyphicon glyphicon-remove"></span></a>
					</td>
				</tr>
				<?php } ?>

			</tbody>
		</table>

<?php require_once 'partials/footer.php' ?>