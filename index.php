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
      <section id="about-us">
         <h2>Nos Principales References</h2>
         <ul class="references">
            <li><a href="#"><img src="/assets/img/One_Piece.png"></a></li>
            <li><a href="#"><img src="/assets/img/Naruto.png"></a></li>
            <li><a href="#"><img src="/assets/img/Bleach.png"></a></li>
            <li><a href="#"><img src="/assets/img/blue_lock.png"></a></li>
            <li><a href="#"><img src="/assets/img/SNk.png"></a></li>
            <li><a href="#"><img src="/assets/img/Eyeshield.png"></a></li>
            <li><a href="#"><img src="/assets/img/MHA.png"></a></li>
            <li><a href="#"><img src="/assets/img/HXH.png"></a></li>
         </ul>
      </section>
      <footer>
         <p>Copyright © 2020 Manga Store. All rights reserved.</p>
      </footer>
</body>

</html>
</main>
</body>

</html>