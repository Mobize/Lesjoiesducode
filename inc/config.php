<?php
session_name('jdc_sess');
session_start();

$current_page = basename($_SERVER['PHP_SELF']);

$pages = array(
	'index.php' => 'Home',
	'random.php' => 'JDC aléatoire',
	'send.php' => 'Envoyer votre JDC',
);

// GENDERS
define('USER_GENDER_MALE', 1);
define('USER_GENDER_FEMALE', 2);

$genders = array(
	USER_GENDER_MALE => 'male',
	USER_GENDER_FEMALE => 'female'
);
$gender_labels = array(
	'male' => 'Homme',
	'female' => 'Femme'
);

// ROLES
define('USER_ROLE_DEFAULT', 0);
define('USER_ROLE_WRITER', 1);
define('USER_ROLE_ADMIN', 2);

$role_labels = array(
	USER_ROLE_DEFAULT => 'Visiteur',
	USER_ROLE_WRITER  => 'Contributeur',
	USER_ROLE_ADMIN   => 'Admin',
);