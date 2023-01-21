<?php
require_once dirname(dirname(dirname(dirname(__DIR__)))) . '/global.php';
require_once  dirname(dirname(dirname(dirname(__DIR__)))) . '/database/PDOSelect.php';

// On vérifie que ce soit bien le gérant du site qui est connecté
if ($_SESSION["user"]["email"] != "gerant@gmail.com") {
   header("Location: ../../../../../index.php");
   exit();
}

// Connection à la BDD
$pdo = getPDO();

// On vérifie la connection à la BDD
if (!$pdo) {
   header("Location: SM.php?error=Erreur lors de la connexion à la base de données");
   exit();
}

$recherche;
if (!empty($_POST["recherche"])) {
   $recherche = $_POST["recherche"];
}

?>

<!DOCTYPE html>
<html>

<head>
   <title>Gestion stock</title>
   <link rel="stylesheet" type="text/css" href="../../../../../../css/style.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../../../../../css/menu.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../../../../../css/basket.css" media="screen" />
</head>

<body>
   <header>
      <?php
      $current_page = "SM";
      require_once(dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))) . "/menu.php");
      ?>
   </header>
   <div class="title">
      <h1>Gestion du stock</h1>
   </div>
   <!-- On affiche sous formes de tableau les données actuelle de la BDD gestion stock -->
   <?php
   // On récupère les données de la BDD

   if (empty($recherche)) {
      $sql = $pdo->query("SELECT * FROM gestionStock");
      $data = $sql->fetchAll();
   } else {
      $sql = $pdo->query("SELECT * FROM gestionStock where id_produit in (SELECT id_produit FROM produit WHERE titreProduit LIKE '%$recherche%');");
      if ($sql) {
         $data = $sql->fetchAll();
      } else {
         $data = [];
      }
   }

   // Affiche l'erreur sql
   ?>

   <div class="table">
      <div class="table-header">
         <div class="header__item">Titre produit</div>
         <div class="header__item">Id Article</div>
         <div class="header__item">Quantite</div>
         <div class="header__item">Modifier</div>
         <div class="header__item">Supprimer</div>
      </div>
      <?php
      // On récupère le message de succés de la mise à jour
      if (!empty($_GET["success"])) {
         echo "<p style='color: green;'>" . $_GET["success"] . "</p>";
      }

      // On récupère le message d'echec de la mise à jour
      if (!empty($_GET["error"])) {
         echo "<p style='color: red;'>" . $_GET["error"] . "</p>";
      }
      ?>

      <!-- On affiche un input pour rechercher un produit -->
      <form action="SM.php" method="post">
         <input type="text" name="recherche" placeholder="Rechercher un produit">
         <input type="submit" value="Rechercher">
      </form>

      <!-- On créer un bouton qui permet d'ajouter un produit en le redirigeant vers la page SMAdd -->
      <button onClick="window.location.href='SMAdd.php'">Ajouter un produit</button>

      <div class="table-content">
         <?php
         // On affiche les données
         foreach ($data as $row) {
            // On récupère le titre du produit avec l'id produit
            $sql = $pdo->query("SELECT titreProduit FROM produit WHERE id_produit = " . $row["id_produit"]);
            $titreProduit = $sql->fetchColumn();

         ?>
            <div class="table-row">
               <div class="table-data"> <?= $titreProduit ?></div>
               <div class="table-data"> <?= $row["id_produit"] ?></div>
               <div class="table-data"> <?= $row["quantite"] ?></div>
               <div class="table-data"><a href="SMUpdate.php?id=<?= $row["id_produit"] ?>">Modifier</a></div>
               <div class="table-data">
                  <a href="javascript:void(0)" onclick="if(confirm('Etes-vous sûr de vouloir supprimer ce produit?')) window.location='SMDelete.php?id=<?= $row["id_produit"] ?>'">Suppr</a>
               </div>
            </div>
         <?php }
         ?>
      </div>
   </div>

</body>

</html>