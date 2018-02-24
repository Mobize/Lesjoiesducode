<?php

// UTILS
function debug($array) {
	return '<pre>'.print_r($array, true).'</pre>';
}

/*
	Coupe une chaine à la longueur $max_length en préservant les mots
*/
function cutString($text, $max_length, $end = '...') {
	// On défini une chaine qu'on va intercaller tous les X caractères en préservant les mots
	$sep = '[@]';

	// Si $max_length est positif et que la chaine $text est plus longue que $max_length
	if ($max_length > 0 && strlen($text) > $max_length) {
		// On intercalle la chaine $sep tous les X caractères
		$text = wordwrap($text, $max_length, $sep, true);
		// On découpe la chaine en plusieurs bouts dans un tableau
		$text = explode($sep, $text);
		// On retourne la première valeur du tableau et on concatène avec la chaine $end
		return $text[0].$end;
	}
	// On retourne la chaine telle qu'on l'a reçu
	return $text;
}

// Re-formatte une date déjà formattée
function getFormatDate($date, $format = 'd/m/Y') {
	return date($format, strtotime($date));
}

function redirectJs($url, $delay = 1) {
	return '
	<script>
	setTimeout(function() {
		location.href = "'.$url.'";
	}, '.($delay * 1000).');
	</script>
	';
}

// AUTHENT

// Mets les infos de l'utilisateur en session pour le connecter
function userLogin($user) {
	if (empty($user)) {
		return false;
	}
	$_SESSION['user_id'] = $user['id'];
	$_SESSION['firstname'] = $user['firstname'];
	$_SESSION['lastname'] = $user['lastname'];
	$_SESSION['role'] = $user['role'];
	return true;
}

// Vérifie si l'utilisateur est connecté
function userIsLogged() {
	return !empty($_SESSION['user_id']);
}

// Vérifie si l'utilisateur a les droits d'accèder à une page
function userIsAllowedAccess($role) {
	if (!empty($_SESSION['role']) && $_SESSION['role'] >= $role) {
		return true;
	}
	return false;
}

// USER

// Récupère le nom complet de l'utilisateur
function user_getFullName($user) {
	return ucwords($user['firstname'].' '.$user['lastname']);
}

// Récupère le libellé du sexe de l'utilisateur (c.f. config.php)
function user_getGenderLabel($gender) {
	global $genders, $gender_labels;
	if (isset($genders[$gender])) {
		$gender = $genders[$gender];
	}
	if (isset($gender_labels[$gender])) {
		return $gender_labels[$gender];
	}
	return 'N/A';
}

// Récupère le libellé du role de l'utilisateur (c.f. config.php)
function user_getRoleLabel($role) {
	global $role_labels;

	if (!empty($role_labels[$role])) {
		return $role_labels[$role];
	}
	return 'N/A';
}

function user_getRoleClass($role) {
	static $role_classes;
	$role_classes = array(
		USER_ROLE_DEFAULT => 'default',
		USER_ROLE_WRITER  => 'info',
		USER_ROLE_ADMIN   => 'danger',
	);

	if (!empty($role_classes[$role])) {
		return $role_classes[$role];
	}
	return 'default';
}