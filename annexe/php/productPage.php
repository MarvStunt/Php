<?php

require_once(__DIR__ . "/productList.php");

?>

<!DOCTYPE html>
<html>

<head>
   <title>Produits - E-commerce de manga</title>
   <link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../css/productPage.css" media="screen" />
</head>

<body>
   <header>
      <nav>
         <ul>
            <li><a class="selection">Les produits</a></li>
            <li><a href="panier.html">Mon panier</a></li>
            <li><a href="../../index.html">Accueil</a></li>
            <li><a href="#">Mon compte</a></li>
            <li><a href="login.html">Se connecter</a></li>
         </ul>
      </nav>
   </header>
   <main>
      <h1>Nos produits</h1>
      <div id="product-grid">
         <?php
         foreach ($products as $prod) {
         ?>
            <div class="product">
               <img src="<?= $prod->getImg(); ?>" alt="<?= $prod->getName(); ?>" />
               <h2><?= $prod->getName(); ?></h2>
               <p><?= $prod->getPrice(); ?>€</p>
               <a href="productPage.php?id=<?= $prod->getId(); ?>">Voir le produit</a>
            </div>
         <?php
         }
         ?>
      </div>
   </main>
</body>

</html>