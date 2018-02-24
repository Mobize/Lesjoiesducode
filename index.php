<?php
require_once 'partials/header.php';

$query = $db->query('SELECT * FROM articles ORDER BY creation_date DESC LIMIT 10');
$articles = $query->fetchAll();
?>
		<h1>Les dernières Joies du code</h1>

		<hr>

		<?php
		foreach($articles as $article) {
			include 'partials/article-common.php';
		}
		?>

<?php require_once 'partials/footer.php' ?>