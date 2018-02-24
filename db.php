<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'lesjoiesducode');

try {

    $db_options = array(
    		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", // On force l'encodage en utf8
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // On récupère tous les résultats en tableau associatif
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING // On affiche des warnings pour les erreurs, à commenter en prod
            );

    $db = new PDO('mysql:host='.HOST.';dbname='.DB.'', USER, PASS, $db_options);

} catch (Exception $e) {
    exit('MySQL Connect Error >> '.$e->getMessage());
}