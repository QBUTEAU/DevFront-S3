<?php

$db = new PDO('mysql:host=mariadb;dbname=bdd', 'id', 'mdp');
$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pseudo = $_GET['pseudo'];
$message = $_GET['message'];

// sauvegarde
$db->query('INSERT INTO Chat (chat_pseudo, chat_message, chat_date) VALUES ("'.$pseudo.'", "'.$message.'", NOW()) ');

?>