<?php
require_once 'partials/header.php';

$id = !empty($_GET['id']) ? intval($_GET['id']) : 0;

if (empty($id)) {
	header('Location: 404.php');
	exit();
}

$query = $db->prepare('SELECT * FROM articles WHERE id = :id');
$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->execute();
$article = $query->fetch();

if (empty($article)) {
	header('Location: 404.php');
	exit();
}

$max_length = 0;
include_once 'partials/article-common.php';

require_once 'partials/footer.php';