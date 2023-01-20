<?php

require_once(dirname(__DIR__) . "/database/PDOSelect.php");
require_once(dirname(__DIR__) . "/global.php");

$pdo = getPDO();
$idProduit = $_GET["id"];

// Récupération du panier du client si il en a un
$requetePanier = $pdo->query("SELECT produits FROM panier WHERE id_client = " . $_SESSION["user"]["id_client"]);
$panier = $requetePanier->fetch(PDO::FETCH_ASSOC);

// Transformer le JSON object en tableau php pour le manipuler si il existe
if ($panier["produits"] != null) {
   $panier = json_decode($panier["produits"], true);
} else {
   $panier = [];
}

// On récupère le produit qu'il veut ajouter au panier
$requeteProd = $pdo->query("SELECT * FROM produit WHERE id_produit = " . $idProduit);
$prod = $requeteProd->fetch(PDO::FETCH_ASSOC);

// On ajoute le produit au panier
$panier[] = $prod;

// Transformer le tableau php en JSON object pour l'envoyer à la base de données
$panier = json_encode($panier);

// Envoi du panier à la base de données si le panier existe sinon on lui créer un panier
$requetePanier = $pdo->query("UPDATE panier SET produits = '$panier' WHERE id_client = " . $_SESSION["user"]["id_client"]);

header("Location: ../account/basketPage.php");
