<?php
require_once 'partials/header.php';

$query = $db->query('SELECT * FROM articles ORDER BY RAND() LIMIT 1');
$article = $query->fetch();
?>

		<h1>Une Joie du code au hasard</h1>

		<hr>

		<?php include_once 'partials/article-common.php' ?>

<?php require_once 'partials/footer.php' ?>