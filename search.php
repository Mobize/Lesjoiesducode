<?php
include_once 'header.php';

if (empty($_GET['search'])) {

	$from = 'index.php';
	if (!empty($_SERVER['HTTP_REFERER'])) {
		$from = $_SERVER['HTTP_REFERER'];
	}

	header('Location: '.$from);
	exit();
}

$search = $_GET['search'];

$page = 0;
if (!empty($_GET['page'])) {
	$page = intval($_GET['page']);
}

$nb_items_per_page = 10;

$query = $db->prepare('SELECT * FROM posts WHERE name LIKE :search OR content LIKE :search LIMIT :start, :nb_items');
$query->bindValue('search', '%'.$search.'%', PDO::PARAM_STR);
$query->bindValue('start', $page * $nb_items_per_page, PDO::PARAM_INT);
$query->bindValue('nb_items', $nb_items_per_page, PDO::PARAM_INT);
$query->execute();
$posts = $query->fetchAll();

$query = $db->prepare('SELECT COUNT(*) as count_posts FROM posts WHERE name LIKE :search OR content LIKE :search');
$query->bindValue('search', '%'.$search.'%', PDO::PARAM_STR);
$query->execute();
$result = $query->fetch();

$count_posts = 0;
if (!empty($result)) {
	$count_posts = $result['count_posts'];
	$nb_pages = ceil($count_posts / $nb_items_per_page);
}
?>
	<h1><?= $count_posts ?> résultat(s) pour la recherche "<?= $search ?>"</h1>

	<hr>

	<?php

	foreach($posts as $post) {
		echo Jdc::displayPost($post);
	}

	for($i = 0; $i < $nb_pages; $i++) {
		echo '<a href="?search='.urlencode($search).'&page='.$i.'">'.($i + 1).'</a> ';
	}

	?>

<?php include_once 'footer.php'; ?>