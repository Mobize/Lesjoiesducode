<?php
include_once 'header.php';

if (empty($_GET['id'])) {
	exit('Undefined parameter id');
}

$id = $_GET['id'];

$sql = 'SELECT * FROM posts WHERE id = :id';
$query = $db->prepare($sql);
$query->bindValue('id', $id, PDO::PARAM_INT);
$query->execute();
$post = $query->fetchAll();

if (!empty($post)) {
	$post = $post[0];
}
?>

	<?php if (!empty($post)) { ?>
	<h1>Joie du code par <?= $post['name'] ?></h1>
	<h2><?= date('d/m/Y H:i:s', strtotime($post['creation_date'])) ?></h2>

	<hr>

	<div class="post">
	    <blockquote>
	      <p>
		  <?= htmlspecialchars($post['content']) ?>
	      </p>
	    </blockquote>
	</div>
	<?php } ?>

<?php include_once 'footer.php'; ?>