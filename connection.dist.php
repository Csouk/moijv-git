<?php
	$connexion = new PDO('mysql:host=localhost;dbname=moijv;charset=utf8', 'root', '');
	
	//--------------------------------- SESSION ------------------------------------
	session_start();

	//---------------------------------- CHEMIN ------------------------------------
	define("RACINE_SITE", $_SERVER['DOCUMENT_ROOT'] . "/PHP/boutique/");
	// echo RACINE_SITE;

	define("URL", 'http://localhost/PHP/moijv-git/');

	//--------------------------------- VARIABLE -----------------------------------
	$content = "";
?>
