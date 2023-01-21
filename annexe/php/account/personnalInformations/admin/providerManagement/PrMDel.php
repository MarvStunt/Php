<?php
require_once dirname(dirname(dirname(dirname(__DIR__)))) . '/global.php';
require_once  dirname(dirname(dirname(dirname(__DIR__)))) . '/database/PDOSelect.php';

// On vérifie que ce soit bien le gérant du site qui est connecté
if ($_SESSION["user"]["email"] != "gerant@gmail.com") {
   header("Location: ../../../../../index.php");
   exit();
}

// Connection à la BDD
$pdo = getPDO();

// On vérifie la connection à la BDD
if (!$pdo) {
   header("Location: PrM.php?error=Erreur lors de la connexion à la base de données");
   exit();
}

$id_fournisseur = $_GET["id"];

// On supprime le produit du stock
$sql = $pdo->query("DELETE FROM fournisseur WHERE id_fournisseur = $id_fournisseur");

// Si la requete c'est bien effectué on redirige vers la page de gestion du stock avec un message de succes
if ($sql) {
   header("Location: PrM.php?success=Client supprimé avec succès");
   exit();
} else {
   header("Location: PrM.php?error=Erreur lors de la suppression du client");
   exit();
}
