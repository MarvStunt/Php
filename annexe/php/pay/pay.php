<?php
require_once dirname(__DIR__) . "/global.php";
require_once dirname(__DIR__) . "/database/PDOSelect.php";
require_once __DIR__ . "/facturation.php";

// Connexion à la BDD
$pdo = getPDO();

// Récupération du panier du client si il en a un
$requetePanier = $pdo->query("SELECT produits FROM panier WHERE id_client = " . $_SESSION["user"]["id_client"]);
$panier = $requetePanier->fetch(PDO::FETCH_ASSOC);
// Vérifie que le panier contient des articles
if (empty($panier["produits"])) {
    header("Location: /index.php?error=Votre panier est vide.");
    exit();
}

// On récupère les produits du panier
$panier = json_decode($panier["produits"], true);

// On créer un tableau associatif avec l'id du produit en clé et la quantité en valeur
$panierQuantite = [];
foreach ($panier as $key => $value) {
    if (array_key_exists($value["id_produit"], $panierQuantite)) {
        $panierQuantite[$value["id_produit"]] += 1;
    } else {
        $panierQuantite[$value["id_produit"]] = 1;
    }
}


// On vient supprimer les produits du panier qui n'ont plus de stock
foreach ($panierQuantite as $key => $value) {
    $requeteStock = $pdo->query("SELECT quantite FROM gestionStock WHERE id_produit = $key");
    $stock = $requeteStock->fetch(PDO::FETCH_ASSOC);
    if ($stock["quantite"] < $value) {
        unset($panierQuantite[$key]);
    }
}

// On vérifie que le panier n'est pas vide
if (empty($panierQuantite)) {
    header("Location: /index.php?error=Un article de votre panier n'est plus disponible, merci de le supprimer.");
    exit();
}

// On envois le mail confirmant la commande

// Récupération des informations pour envoyer le mail
$requeteIdPanier = $pdo->query("SELECT id_panier FROM panier WHERE id_client = " . $_SESSION["user"]["id_client"]);
$idPanier = $requeteIdPanier->fetch(PDO::FETCH_ASSOC);

$total = 0;
foreach ($panierQuantite as $key => $value) {
    $requeteProd = $pdo->query("SELECT * FROM produit WHERE id_produit = " . $key);
    $prod = $requeteProd->fetch(PDO::FETCH_ASSOC);
    $total += $prod["prixPublic"] * $value;
}

$date = date("Y-m-d H:i:s");
$facturation = new facturation($idPanier["id_panier"], $date, $_SESSION["user"]["nom"], $_SESSION["user"]["prenom"], "conilmarvin@gmail.com", $panier,$total);
if(!$facturation->sendMail()){
    header("Location: /index.php?error=Une erreur est survenue lors de l'envoi du mail !");
    exit();
}

$errorMessage = $facturation->updateBDD();
if(!empty($errorMessage)){
    header("Location: /index.php?error=$errorMessage");
    exit();
}
    
header("Location: /index.php?success=Votre commande à bien été prise en compte, merci de votre confiance.");
