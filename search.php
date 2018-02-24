<?php
include_once 'header.php';

if (empty($_GET['search'])) {
	header('Location: index.php');
	exit();
}

$search = $_GET['search'];

$sql = 'SELECT * FROM posts WHERE content LIKE :content ORDER BY creation_date DESC';
$query = $db->prepare($sql);
$query->bindValue('content', '%'.$search.'%', PDO::PARAM_STR);
$query->execute();
$posts = $query->fetchAll();
$count_posts = count($posts);
?>
	<?php if ($count_posts == 0) { ?>
	<h1>Aucun résultat pour la recherche "<?= $search ?>"</h1>
	<?php } else { ?>
	<h1><?= $count_posts ?> résultat(s) pour la recherche "<?= $search ?>"</h1>

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

	<?php } ?>

<?php include_once 'footer.php'; ?>