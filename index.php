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

// Reception des plus de stock
if (!empty($_GET["success"])) {
   echo "<p style='color:green'>" . $_GET["success"] . "</p>";
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" type="text/css" href="css/menu.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="css/acceuil.css" media="screen" />
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
      <div class="title">
         <h1>Qui sommes nous ?</h1>
         <div class="presentation">Manga K est une entreprise fictive crée uniquement dans le but d'avoir une bonne note lors d'un projet PHP.</div>
         <div class="presentation">Il ne s'agit en aucun cas d'une conccurence directe avec la <a class="link" href="https://librairiedud.com/" target="_blank">librairie du D.</a> </div>
      </div>
      <section id="reference">
         <div class="title">
            <h1>Nos principales références</h1>
         </div>
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
         <div class="title">
            <h1>Nos principaux auteurs</h1>
         </div>
         <ul class="references">
            <li><button onclick="location.href='annexe/php/products/productPage.php?auteur=Eiichiro Oda'" class="auteur" role="button"><span class="text">Eiichirō Oda</span></button></li>
            <li><button onclick="location.href='annexe/php/products/productPage.php?auteur=Masashi Kishimoto'" class="auteur" role="button"><span class="text">Masashi Kishimoto</span></button></li>
            <li><button onclick="location.href='annexe/php/products/productPage.php?auteur=Tite Kubo'" class="auteur" role="button"><span class="text">Tite Kubo</span></button></li>
            <li><button onclick="location.href='annexe/php/products/productPage.php?auteur=Yosuke Nomura'" class="auteur" role="button"><span class="text">Yosuke Nomura</span></button></li>
            <li><button onclick="location.href='annexe/php/products/productPage.php?auteur=Hajime Isayama'" class="auteur" role="button"><span class="text">Hajime Isayama</span></button></li>
            <li><button onclick="location.href='annexe/php/products/productPage.php?auteur=Yosuke Murata'" class="auteur" role="button"><span class="text">Yosuke Murata</span></button></li>
            <li><button onclick="location.href='annexe/php/products/productPage.php?auteur=Kohei Horikoshi'" class="auteur" role="button"><span class="text">Kōhei Horikoshi</span></button></li>
            <li><button onclick="location.href='annexe/php/products/productPage.php?auteur=Yoshihiro Togashi'" class="auteur" role="button"><span class="text">Yoshihiro Togashi</span></button></li>
         </ul>
      </section>
      <footer>
         <p>S3T - G4</p>
         <p>Conil Marvin - Lopes Mateus</p>
         <p>Copyright © 2023 Manga K. All rights reserved.</p>
      </footer>
</body>

</html>
</main>
</body>

</html>