<?php

require_once(__DIR__ . "/product.php");

$id_prod = $_GET["id"];


?>

<!DOCTYPE html>
<html>

<head>
   <title>Produits - E-commerce de manga</title>
   <link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen" />
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
      <?php

      ?>
   </main>
</body>

</html>