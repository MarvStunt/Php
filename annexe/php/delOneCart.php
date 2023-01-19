<?php
require_once(__DIR__ . "/PDOSelect.php");
require_once(__DIR__ . "/global.php");

$pdo = getPDO();
$idProduit = $_GET["id"];

// Récupération du panier du client si il en a un
$requetePanier = $pdo->query("SELECT produits FROM panier WHERE id_client = " . $_SESSION["user"]["id_client"]);
$panier = $requetePanier->fetch(PDO::FETCH_ASSOC);

// Transformer le JSON object en tableau php pour le manipuler
if ($panier["produits"] != null) {
   $panier = json_decode($panier["produits"], true);
}

// On récupère le produit qu'il veut ajouter au panier
$requeteProd = $pdo->query("SELECT * FROM produit WHERE id_produit = " . $idProduit);
$prod = $requeteProd->fetch(PDO::FETCH_ASSOC);

// On cherche la première instance du produit dans le panier et on la supprime
foreach ($panier as $key => $value) {
   if ($value["id_produit"] == $prod["id_produit"]) {
      unset($panier[$key]);
      break;
   }
}

// On récupère sa taille
$taille = count($panier);

// Transformer le tableau php en JSON object pour l'envoyer à la base de données
$panier = json_encode($panier);

// Envoi du panier à la base de données si le panier contient encore des produits sinon on supprime le panier
if ($taille == 0) {
   $requetePanier = $pdo->query("DELETE FROM panier WHERE id_client = " . $_SESSION["user"]["id_client"]);
} else {
   $requetePanier = $pdo->query("UPDATE panier SET produits = '$panier' WHERE id_client = " . $_SESSION["user"]["id_client"]);
}

header("Location: basketPage.php");
