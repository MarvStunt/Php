<?php

require_once(__DIR__ . "/productList.php");

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
         ?>
      </header>
   </header>
   <main>
      <div class="title">
         <h1>Nos produits</h1>
      </div>
      <div id="product-grid">
         <?php
         foreach ($products as $prod) {
         ?>
            <div class="product">
               <img src="<?= $prod->getImg(); ?>" alt="<?= $prod->getName(); ?>" />
               <div class="product-name"><?= $prod->getName(); ?></div>
               <div class="product-price"><?= $prod->getPrice(); ?> €</div>
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