<?php
require_once dirname(__DIR__) . "/database/PDOSelect.php";
require_once dirname(__DIR__) . "/global.php";

$pdo = getPDO();

// Récupération du panier du client si il en a un
$requetePanier = $pdo->query("SELECT produits FROM panier WHERE id_client = " . $_SESSION["user"]["id_client"]);
$panier = $requetePanier->fetch(PDO::FETCH_ASSOC);



// Transformer le JSON object en tableau php pour le manipuler si il existe
if ($panier["produits"] != null) {
   $panier = json_decode($panier["produits"], true);
} else {
   $panier = [];
}


// Supprimer le produit du panier
foreach ($panier as $key => $value) {
   if ($value["id_produit"] == $_GET["id"]) {
      unset($panier[$key]);
   }
}


$taille = count($panier);
// Transformer le tableau php en JSON object pour l'envoyer à la base de données
$panier = json_encode($panier);

// Envoi du nouveau panier à la BDD si la taille du tableau est de 0 alors on supprime son panier de la BDD
if ($taille == 0) {
   $requetePanier = $pdo->query("UPDATE panier SET produits = '[]' WHERE id_client = " . $_SESSION["user"]["id_client"]);
} else {
   $requetePanier = $pdo->query("UPDATE panier SET produits = '$panier' WHERE id_client = " . $_SESSION["user"]["id_client"]);
}

$erreur = $pdo->errorInfo()[2];
echo $erreur;

header("Location: ../account/basketPage.php?delete=true");
