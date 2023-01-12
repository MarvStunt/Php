<?php

require_once(__DIR__ . "/productList.php");

?>

<!DOCTYPE html>
<html>

<head>
   <title>Produits - E-commerce de manga</title>
   <link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../css/productPage.css" media="screen" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
   <header>
      <nav>
         <ul>
            <li><a class="selection">Les produits</a></li>
            <li><a href="../html/basketPage.html">Mon panier</a></li>
            <li><a href="../../index.html">Accueil</a></li>
            <li><a href="#">Mon compte</a></li>
            <li><a href="../html/loginPage.html">Se connecter</a></li>
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
               <div class="product-name"><?= $prod->getName(); ?></div>
               <div class="product-price"><?= $prod->getPrice(); ?>€</div>
               <div class="prod">
                  <button onclick="location.href='productDesc.php?id=<?= $prod->getId(); ?>'" class="voirProduit" role="button"><span class="text">Voir produit</span></button>
               </div>
            </div>
         <?php
         }
         ?>
      </div>
   </main>
</body>

</html>