<?php
require_once dirname(dirname(__DIR__)) . '/global.php';
require_once dirname(dirname(__DIR__)) . '/database/PDOSelect.php';

if (!isLoggedIn()) {
   header("Location: loginPage.php?error=Veuillez vous connecter pour accéder à votre panier");
   exit();
}
$pdo = getPDO();
// récupération les facturations du client
$requeteFacturations = $pdo->query("SELECT * FROM facturation WHERE id_client = " . $_SESSION["user"]["id_client"]);
$facturations = $requeteFacturations->fetchAll(PDO::FETCH_ASSOC);

// On trie les facturations par l'id facturation
usort($facturations, function ($a, $b) {
   return $a['id_facturation'] <=> $b['id_facturation'];
});

?>

<!DOCTYPE html>
<html>

<head>
   <link rel="icon" type="image/png" href="../../../../assets/img/logo.png" />
   <title>Mon compte</title>
   <link rel="icon" type="image/png" href="../../../../assets/img/logo.png" />
   <link rel="stylesheet" type="text/css" href="../../../../css/style.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../../../css/menu.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../../../css/basket.css" media="screen" />
</head>

<body>
   <header>
      <?php
      $current_page = "billingPage";
      require_once(dirname(dirname(dirname(dirname(__DIR__)))) . "/menu.php");
      ?>
   </header>
   <h1>Facturations</h1>
   <div class="table">
      <div class="table-header">
         <div class="header__item">Article</div>
         <div class="header__item">Date de facturation</div>
         <div class="header__item">Prix</div>
      </div>
      <div class="table-content">
         <?php
         // On affiche toutes les dernières facture du client si il en a sous la forme d'un tableau (Date de création, titre du produit, prixTotal) sinon on affiche "aucune factures"
         if (count($facturations) > 0) {
            $index = 0;
            foreach ($facturations as $facturation) {
         ?>
               <div class="table-row">
                  <?php

                  // On récupère la liste des produits de la facturation
                  $listeProduit = $facturation["listeProduit"];

                  // On transforme la liste des produits en tableau
                  $listeProduit = json_decode($listeProduit, true);

                  // On récupère tout les titres des produits
                  $listeTitreProduits = array_column($listeProduit, "titreProduit");

                  // On vérifie si il n'y a pas de doublons, si il y a un doublons alors on augmente sa quantite de 1
                  $titreProduits = array_count_values($listeTitreProduits);

                  // On récupère le premier produit de la liste des produits si l'index existe
                  $produit = reset($listeProduit);

                  $prixProduit = $produit["prixPublic"] * $titreProduits[$produit["titreProduit"]];

                  // On récupère les informations du produit et les affiches
                  ?>
                  <div class="table-data"> <?= $produit["titreProduit"] . ' x ' . $titreProduits[$produit["titreProduit"]] ?></div>
                  <div class="table-data"> <?= $facturation["dateCreation"] ?></div>
                  <div class="table-data"> <?= $prixProduit ?>€</div>
               </div>
         <?php }
         } ?>
      </div>
   </div>
</body>

</html>