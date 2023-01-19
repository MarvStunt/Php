<?php

require __DIR__ . '/BDD.php';

// Connexion à la base de données
$pdo = new PDO(
      'mysql:host=databases.000webhost.com;dbname=id20000359_projectphp',
      'id20000359_lopes_conil',
      '#0&?HBy{RTN7CJV5'
      );

// Vérification de la connection
if(!$pdo){
   echo "Error : Unable to connect to MySQL.";
   die();
} else {
   echo "Connected to MySQL successfully!";
}