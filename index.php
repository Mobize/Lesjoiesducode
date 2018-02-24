<?php
include_once 'header.php';

$page = 0;
if (!empty($_GET['page'])) {
	$page = intval($_GET['page']);
}

$nb_items_per_page = 10;

$query = $db->prepare('SELECT COUNT(*) as count_posts FROM posts ORDER BY creation_date DESC');
$query->execute();
$posts = $query->fetch();

$count_total_posts = 0;
if (!empty($posts)) {
	$count_total_posts = $posts['count_posts'];
	$nb_pages = ceil($count_total_posts / $nb_items_per_page);
}

$query = $db->prepare('SELECT * FROM posts ORDER BY creation_date DESC LIMIT :start, :nb_items');
$query->bindValue('start', $page * $nb_items_per_page, PDO::PARAM_INT);
$query->bindValue('nb_items', $nb_items_per_page, PDO::PARAM_INT);
$query->execute();
$posts = $query->fetchAll();
?>
	<h1>Les dernières Joies du code</h1>

	<hr>

	<?php
	foreach($posts as $post) {
		echo Jdc::displayPost($post);
	}

	if ($count_total_posts > 0) {
		for($i = 0; $i < $nb_pages; $i++) {
			echo '<a href="?page='.$i.'">'.($i + 1).'</a> ';
		}
	}
	?>

<?php include_once 'footer.php'; ?>