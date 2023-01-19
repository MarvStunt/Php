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
      <h1>Bienvenue sur notre e-commerce de manga !</h1>
      <p>Retrouvez ici tous vos mangas préférés, ainsi que de nombreux produits dérivés pour compléter votre collection.
      </p>
      <p>N'hésitez pas à vous connecter ou à créer un compte pour profiter de tous nos avantages et suivre votre
         commande en temps réel.</p>
   </main>
</body>

</html>