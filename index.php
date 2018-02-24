<?php
include_once 'header.php';

$sql = 'SELECT * FROM posts ORDER BY creation_date DESC LIMIT 10';
$query = $db->prepare($sql);
$query->execute();
$posts = $query->fetchAll();
?>

	<h1>Les dernières Joies du code</h1>

	<hr>

	<?php foreach($posts as $post) { ?>
	<div class="post">
	    <p><?= date('d/m/Y H:i:s', strtotime($post['creation_date'])) ?> par <a href="#"><?= $post['name'] ?></a></p>

	    <blockquote>
	      <p>
	      <?php if (strlen($post['content']) > 100) { ?>
	      <?= substr($post['content'], 0, 100).'...' ?>
	      <br>
	      <a href="post.php?id=<?= $post['id'] ?>">Lire la suite</a>
	      <?php } else { ?>
		  <?= $post['content'] ?>
	      <?php } ?>
	      </p>
	    </blockquote>
	</div>
	<?php } ?>

<?php include_once 'footer.php'; ?>