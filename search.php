<?php
require_once 'partials/header.php';

$search = !empty($_GET['search']) ? $_GET['search'] : '';

$count_results = 0;
$search_results = array();

if (!empty($search)) {
	$query = $db->prepare('SELECT * FROM articles WHERE name LIKE :search OR content LIKE :search');
	$query->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
	$query->execute();

	$search_results = $query->fetchAll();
	$count_results = count($search_results);
}
?>
	<h1><?= $count_results ?> résultat(s) pour la recherche "<?= $search ?>"</h1>
	<hr>

	<?php
	foreach($search_results as $article) {
		include 'partials/article-common.php';
	}
	?>

<?php require_once 'partials/footer.php' ?>