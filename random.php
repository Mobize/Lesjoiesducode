<?php
include_once 'header.php';

$query = $db->prepare('SELECT * FROM posts ORDER BY RAND() LIMIT 1');
$query->execute();
$post = $query->fetch();
?>
	<h1>Une Joie du code au hasard</h1>

	<hr>

	<?php if (!empty($post)) {
		echo Jdc::displayPost($post);
	} ?>

<?php include_once 'footer.php'; ?>