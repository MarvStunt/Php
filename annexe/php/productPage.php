<?php

require_once(__DIR__ . "/PDOSelect.php");

?>

<!DOCTYPE html>
<html>

<head>
   <title>Produits - E-commerce de manga</title>
   <link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../css/productPage.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../css/menu.css" media="screen" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
   <header>
      <header>
         <?php
         $current_page = "productPage";
         require_once(dirname(dirname(__DIR__)) . "/menu.php");

         // On affiche le message d'ajout à son panier en vert
         if (isset($_GET["add"])) {
            echo "<p style='color:green'>Le produit a bien été ajouté à votre panier</p>";
         }
         ?>
      </header>
   </header>
   <main>
      <div class="title">
         <h1>Nos produits</h1>
      </div>
      <div id="product-grid">
         <?php
         require_once(__DIR__ . "/product.php");
         // Connection à la base de données
         $pdo = getPDO();
         if ($pdo == null) {
            echo "Erreur de connexion à la base de données";
            exit();
         }

         // Récupération des produits
         $requeteProd = $pdo->query("SELECT * FROM produit");
         $products = $requeteProd->fetchAll(PDO::FETCH_ASSOC);
         // Création des objets Product
         foreach ($products as $key => $value) {
            $products[$key] = new Product($value["id_produit"], $value["titreProduit"], $value["prixPublic"], $value["image"]);
         }

         // Récupération des stocks
         $requeteStock = $pdo->query("SELECT * FROM gestionStock");
         $stocks = $requeteStock->fetchAll(PDO::FETCH_ASSOC);

         // On garde que les produits qui n'ont plus de stock
         foreach ($stocks as $key => $value) {
            if ($value["quantite"] > 0) {
               unset($stocks[$key]);
            }
         }

         foreach ($products as $prod) {
         ?>
            <div class="product">
               <img src="<?= $prod->getImg(); ?>" alt="<?= $prod->getName(); ?>" />
               <div class="product-name"><?= $prod->getName(); ?></div>
               <div class="product-price"><?= $prod->getPrice(); ?> €</div>
               <div class="prod">
                  <?php
                  if (in_array($prod->getId(), array_column($stocks, "id_produit"))) {
                  ?>
                     <button onclick="location.href='productDesc.php?id=<?= $prod->getId(); ?>'" class="voirProduitDisabled" role="button" disabled><span class="text">PLUS DE STOCK</span></button>
                  <?php
                  } else {
                  ?>
                     <button onclick="location.href='productDesc.php?id=<?= $prod->getId(); ?>'" class="voirProduit" role="button"><span class="text">Voir produit</span></button>
                  <?php
                  }
                  ?>
               </div>
            </div>
         <?php
         }
         ?>
      </div>
   </main>
</body>

</html>