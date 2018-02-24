<?php
include_once 'header.php';

if (empty($_GET['id'])) {
	exit('Paramètre id manquant');
}

$id = $_GET['id'];

$query = $db->prepare('SELECT * FROM posts WHERE id = :id');
$query->bindValue('id', $id, PDO::PARAM_INT);
$query->execute();
$post = $query->fetch();

if (!empty($post)) {
?>
	<h1><?= $post['name'] ?></h1>

	<hr>

	<?php

	echo Jdc::displayFullPost($post);

}

include_once 'footer.php';
?>