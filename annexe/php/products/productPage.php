   <?php

   require_once(dirname(__DIR__) . "/database/PDOSelect.php");

   ?>

   <!DOCTYPE html>
   <html>

   <head>
      <title>Produits - E-commerce de manga</title>
      <link rel="stylesheet" type="text/css" href="../../../css/style.css" media="screen" />
      <link rel="stylesheet" type="text/css" href="../../../css/productPage.css" media="screen" />
      <link rel="stylesheet" type="text/css" href="../../../css/menu.css" media="screen" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
   </head>

   <body>
      <header>
         <header>
            <?php
            if (!empty($_GET["BestSeller"])) {
               $current_page = "BestSeller";
            } else if (!empty($_GET["New"])) {
               $current_page = "New";
            } else {
               $current_page = "productPage";
            }
            require_once(dirname(dirname(dirname(__DIR__))) . "/menu.php");

            // On affiche le message d'ajout à son panier en vert
            if (isset($_GET["add"])) {
               echo "<p style='color:green'>Le produit a bien été ajouté à votre panier</p>";
            }
            ?>
         </header>
      </header>
      <main>
         <div class="title">
            <?php if (!empty($_GET["reference"])) {
            ?>
               <img class="reference" src="../../../assets/img/<?= $_GET["reference"] ?>.png" alt=<?= $_GET["reference"] ?>>
               <h1 class="pageTitle">Nos produits <?= $_GET["reference"] ?> </h1>
               <img class="reference" src="../../../assets/img/<?= $_GET["reference"] ?>.png" alt=<?= $_GET["reference"] ?>>
            <?php } else if (!empty($_GET["New"])) { ?>
               <h1 class="productPageTitle">Nouveaux arrivages</h1>
            <?php } else if (!empty($_GET["BestSeller"])) { ?>
               <h1 class="productPageTitle">Les plus populaires</h1>
            <?php } else if (!empty($_GET["auteur"])) { ?>
               <h1 class="productPageTitle"><?= $_GET["auteur"] ?></h1>
            <?php } else {
               $current_page = "productPage";
            ?>
               <h1 class="productPageTitle">Nos produits</h1>
            <?php } ?>
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

            if (!empty($_GET["reference"])) {
               // Récupération des produits
               $name = $_GET['reference'];
               $requeteProd = $pdo->query("SELECT * FROM produit where nom='$name'");
               $products = $requeteProd->fetchAll(PDO::FETCH_ASSOC);
            } else if (!empty($_GET["BestSeller"])) {

               // // Récupération des produits
               $requeteProd = $pdo->query("SELECT * FROM produit p, gestionStock g WHERE g.id_produit=p.id_produit AND g.quantite<=10");
               $products = $requeteProd->fetchAll(PDO::FETCH_ASSOC);
            } else if (!empty($_GET["New"])) {

               // Récupération des produits
               $requeteProd = $pdo->query("SELECT * FROM produit p, gestionStock g WHERE g.id_produit=p.id_produit AND g.dateModif >= DATE_SUB(CURRENT_DATE(), INTERVAL 15 DAY)");
               $products = $requeteProd->fetchAll(PDO::FETCH_ASSOC);
            } else if (!empty($_GET["auteur"])) {

               // Récupération des produits
               $auteur = $_GET["auteur"];
               $requeteProd = $pdo->query("SELECT * FROM produit WHERE auteur='$auteur'");
               $products = $requeteProd->fetchAll(PDO::FETCH_ASSOC);
            } else {
               // Récupération des produits
               $requeteProd = $pdo->query("SELECT * FROM produit");
               $products = $requeteProd->fetchAll(PDO::FETCH_ASSOC);
            }

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
                        <button class="voirProduit" role="button" disabled><span class="text">PLUS DE STOCK</span></button>
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