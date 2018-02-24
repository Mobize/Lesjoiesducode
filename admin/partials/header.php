<?php
require_once 'inc/config.php';
require_once '../inc/db.php';
require_once '../inc/func.php';

if (!userIsLogged() || !userIsAllowedAccess(USER_ROLE_WRITER)) {
	header('Location: ../login.php');
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../favicon.ico">

	<title>Espace d'administration</title>

	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="css/jquery.dataTables.min.css">
	<link href="css/styles.css" rel="stylesheet">

</head>

<body>

	<?php include_once 'partials/navbar-header.php' ?>

	<div class="container-fluid">

		<div class="row">

			<div id="main-container" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">