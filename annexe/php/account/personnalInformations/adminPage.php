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
</head>

<body>
   <header>
      <?php
      $current_page = "adminPage";
      require_once(dirname(dirname(dirname(dirname(__DIR__)))) . "/menu.php");
      ?>
   </header>
   <h1>Page d'administration du site</h1>

   <button onclick="location.href='./admin/stockManagement/SM.php'">Gérer les stocks</a>
   <button onclick="location.href='./admin/userManagement/UM.php'">Gérer les utilisateurs</a>
   <button onclick="location.href='./admin/productManagement/PM.php'">Gérer les produits</a>
   <button onclick="location.href='./admin/providerManagement/PrM.php'">Gérer les fournisseur</a>
   <button onclick="location.href='./admin/stats/stats.php'">Consulter les statistiques du site</a>

</body>

</html>