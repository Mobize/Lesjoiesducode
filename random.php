<?php
include_once 'header.php';

$sql = 'SELECT * FROM posts ORDER BY RAND() LIMIT 1';
$query = $db->prepare($sql);
$query->execute();
$post = $query->fetchAll();
if (!empty($post)) {
	$post = $post[0];
}
?>

	<h1>Une Joie du code au hasard</h1>

	<hr>

	<?php if (!empty($post)) { ?>
	<div class="post">
	    <p><?= date('d/m/Y H:i:s', strtotime($post['creation_date'])) ?> par <a href="#"><?= $post['name'] ?></a></p>

	    <blockquote>
	      <p>
	      <?php if (strlen($post['content']) > 100) { ?>
	      <?= substr($post['content'], 0, 100).'...' ?>
	      <a href="post.php?id=<?= $post['id'] ?>">Lire la suite</a>
	      <?php } else { ?>
		  <?= $post['content'] ?>
	      <?php } ?>
	      </p>
	    </blockquote>
	</div>
	<?php } ?>

<?php include_once 'footer.php'; ?>