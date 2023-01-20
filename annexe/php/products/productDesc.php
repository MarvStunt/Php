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
      <?php
      $current_page = "productDesc";
      require_once(dirname(dirname(dirname(__DIR__))) . "/menu.php");
      ?>
   </header>
   <main>
      <h1>Nos produits</h1>
      <?php
      require_once(__DIR__ . "/product.php");
      require_once(dirname(__DIR__) . "/database/PDOSelect.php");
      // Reception de l'id du produit
      $id_prod = $_GET["id"];

      // Connection à la base de données
      $pdo = getPDO();
      if ($pdo == null) {
         echo "Erreur de connexion à la base de données";
         exit();
      }

      // Récupération des produits
      $requeteProd = $pdo->query("SELECT * FROM produit WHERE id_produit = $id_prod");
      $product = $requeteProd->fetch(PDO::FETCH_ASSOC);

      // Création de l'objet Product
      $product = new Product($product["id_produit"], $product["titreProduit"], $product["prixPublic"], $product["image"]);

      // Récupération du stock du produit
      $requeteStock = $pdo->query("SELECT * FROM gestionStock WHERE id_produit = $id_prod");
      $stock = $requeteStock->fetch(PDO::FETCH_ASSOC);

      ?>
      <div class="productDesc">
         <div class="productDescImg">
            <img src="../../../img/<?= $product->getImg() ?>" alt="<?= $product->getName() ?>">
         </div>
         <div class="productDescText">
            <h2><?= $product->getName() ?></h2>
            <p><?= $product->getPrice() ?> €</p>
            <p>Stock : <?= $stock["quantite"] ?></p>
            <p><?= $product->getDescription() ?></p>
         </div>
         <a href="../pay/addToCart.php?id=<?= $id_prod ?>">
            <button>Ajouter au panier</button>
         </a>
      </div>
   </main>
</body>

</html>