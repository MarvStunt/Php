<?php
include(__DIR__ . "/annexe/php/global.php");

// Si le cookie login n'est pas vide alors on rétablis la session
if (!empty($_COOKIE["login"])) {
   $_SESSION["login"] = $_COOKIE["login"];
}

// Reception des erreurs
if (!empty($_GET["error"])) {
   echo "<p style='color:red'>" . $_GET["error"] . "</p>";
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" type="text/css" href="css/menu.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../css/menu.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../css/acceuil.css" media="screen" />
   <title>Accueil</title>
</head>

<body>
   <header>
      <?php
      $current_page = "homePage";
      require_once(__DIR__ . "/menu.php")
      ?>
   </header>
   <main>
      <section id="reference">
         <h2>Nos Principales References</h2>
         <ul class="references">
            <li><a href="annexe/php/products/productPage.php?reference=OnePiece"><img src="/assets/img/OnePiece.png"></a></li>
            <li><a href="annexe/php/products/productPage.php?reference=Naruto"><img src="/assets/img/Naruto.png"></a></li>
            <li><a href="annexe/php/products/productPage.php?reference=Bleach"><img src="/assets/img/Bleach.png"></a></li>
            <li><a href="annexe/php/products/productPage.php?reference=BlueLock"><img src="/assets/img/BlueLock.png"></a></li>
            <li><a href="annexe/php/products/productPage.php?reference=SNK"><img src="/assets/img/SNK.png"></a></li>
            <li><a href="annexe/php/products/productPage.php?reference=Eyeshield"><img src="/assets/img/Eyeshield.png"></a></li>
            <li><a href="annexe/php/products/productPage.php?reference=MHA"><img src="/assets/img/MHA.png"></a></li>
            <li><a href="annexe/php/products/productPage.php?reference=HXH"><img src="/assets/img/HXH.png"></a></li>
         </ul>
      </section>
      <section id="auteurs">
         <h2>Nos Principaux auteurs</h2>
         <ul class="references">
            <li><button onclick="location.href='annexe/php/products/productPage.php?auteur=Eiichiro Oda'" class="voirProduit" role="button"><span class="text">Eiichirō Oda</span></button></li>
            <li><button onclick="location.href='annexe/php/products/productPage.php?auteur=Masashi Kishimoto'" class="voirProduit" role="button"><span class="text">Masashi Kishimoto</span></button></li>
            <li><button onclick="location.href='annexe/php/products/productPage.php?auteur=Tite Kubo'" class="voirProduit" role="button"><span class="text">Tite Kubo</span></button></li>
            <li><button onclick="location.href='annexe/php/products/productPage.php?auteur=Yosuke Nomura'" class="voirProduit" role="button"><span class="text">Yosuke Nomura</span></button></li>
            <li><button onclick="location.href='annexe/php/products/productPage.php?auteur=Hajime Isayama'" class="voirProduit" role="button"><span class="text">Hajime Isayama</span></button></li>
            <li><button onclick="location.href='annexe/php/products/productPage.php?auteur=Yosuke Murata'" class="voirProduit" role="button"><span class="text">Yosuke Murata</span></button></li>
            <li><button onclick="location.href='annexe/php/products/productPage.php?auteur=Kohei Horikoshi'" class="voirProduit" role="button"><span class="text">Kōhei Horikoshi</span></button></li>
            <li><button onclick="location.href='annexe/php/products/productPage.php?auteur=Yoshihiro Togashi'" class="voirProduit" role="button"><span class="text">Yoshihiro Togashi</span></button></li>
         </ul>
      </section>
      <footer>
         <p>Copyright © 2020 Manga K. All rights reserved.</p>
      </footer>
</body>

</html>
</main>
</body>

</html>