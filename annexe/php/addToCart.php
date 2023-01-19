<?php
require_once __DIR__ . "/global.php";
require_once (__DIR__ . "/PDOSelect.php");

// On vérifie si l'utilisateur est connecté
if (!isLoggedIn()) {
    header("Location: loginPage.php?error=Veuillez vous connecter");
    exit();
}

$pdo = getPDO();
if ($pdo == null) {
    echo "Erreur de connexion à la base de données";
    exit();
}

// Récupération du panier du client si il en a un
$requetePanier = $pdo->query("SELECT produits FROM panier WHERE id_client = " . $_SESSION["user"]["id_client"]);
$panier = $requetePanier->fetch(PDO::FETCH_ASSOC);

// Transformer le JSON object en tableau php pour le manipuler si il existe
if ($panier["produits"] != null) {
    $panier = json_decode($panier["produits"], true);
} else {
    $panier = [];
}

// Récupération du produit
$requeteProd = $pdo->query("SELECT * FROM produit WHERE id_produit = " . $_GET["id"]);
$prod = $requeteProd->fetch(PDO::FETCH_ASSOC);


// Ajout du produit à la liste de produits du panier
$panier[] = $prod;

// Transformer le tableau php en JSON object pour l'envoyer à la base de données
$panier = json_encode($panier);

// Envoi du panier à la base de données si le panier existe sinon on lui créer un panier
if ($requetePanier->rowCount() > 0) {
    $requetePanier = $pdo->query("UPDATE panier SET produits = '$panier' WHERE id_client = " . $_SESSION["user"]["id_client"]);
} else {
    $requetePanier = $pdo->query("INSERT INTO panier (id_client, produits) VALUES (" . $_SESSION["user"]["id_client"] . ", '$panier')");
}

// On renvois l'utilisateur sur la page produits et lui disant que son article à bien été ajouté au panie
header("Location: productPage.php?add=true");


