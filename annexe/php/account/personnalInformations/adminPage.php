<?php
require_once dirname(dirname(__DIR__)) . '/global.php';
require_once dirname(dirname(__DIR__)) . '/database/PDOSelect.php';

if ($_SESSION["user"]["email"] != "gerant@gmail.com") {
   header("Location: ../../../../../index.php");
   exit();
}
?>

<!DOCTYPE html>
<html>

<head>
   <title>Page admin</title>
   <link rel="stylesheet" type="text/css" href="../../../../css/style.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../../../css/menu.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../../../css/adminPage.css" media="screen" />
</head>

<body>
   <header>
      <?php
      $current_page = "adminPage";
      require_once(dirname(dirname(dirname(dirname(__DIR__)))) . "/menu.php");
      ?>
   </header>
   <div class="title">
      <h1>Page d'administration du site</h1>
   </div>

   <div class="buttons">
      <button class="btn" onclick="location.href='./admin/stockManagement/SM.php'">Gérer les stocks</button>
      <button class="btn" onclick="location.href='./admin/userManagement/UM.php'">Gérer les utilisateurs</button>
      <button class="btn" onclick="location.href='./admin/productManagement/PM.php'">Gérer les produits</button>
      <button class="btn" onclick="location.href='./admin/providerManagement/PrM.php'">Gérer les fournisseur</button>
      <button class="btn" onclick="location.href='./admin/stats/stats.php'">Consulter les statistiques du site</button>
   </div>
</body>

</html>