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
   header("Location: UM.php?error=Erreur lors de la connexion à la base de données");
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
   <title>Gestion utilisateurs</title>
   <link rel="stylesheet" type="text/css" href="../../../../../../css/style.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../../../../../css/menu.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../../../../../css/basket.css" media="screen" />
</head>

<body>
   <header>
      <?php
      $current_page = "UM";
      require_once(dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))) . "/menu.php");
      ?>
   </header>
   <div class="title">
      <h1>Gestion des utilisateurs</h1>
   </div>
   <!-- On affiche sous formes de tableau les données actuelle de la BDD gestion stock -->
   <?php
   // On récupère les données de la BDD

   if (empty($recherche)) {
      $sql = $pdo->query("SELECT * FROM client");
      $data = $sql->fetchAll();
   } else {
      $sql = $pdo->query("SELECT * FROM client where id_client in (SELECT id_client FROM client WHERE nom LIKE '%$recherche%');");
      if ($sql) {
         $data = $sql->fetchAll();
      } else {
         $data = [];
      }
   }

   ?>

   <div class="table">
      <div class="table-header7">
         <div class="header__item7">E-mail</div>
         <div class="header__item7">Id</div>
         <div class="header__item7">Nom</div>
         <div class="header__item7">Prenom</div>
         <div class="header__item7">Adresse</div>
         <div class="header__item7">Supprimer</div>
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
      <form action="UM.php" method="post">
         <input type="text" name="recherche" placeholder="Rechercher un client (nom)">
         <input type="submit" value="Rechercher">
      </form>

      <!-- On créer un bouton qui permet d'ajouter un produit en le redirigeant vers la page PMAdd -->
      <button onClick="window.location.href='./UMAdd.php'">Ajouter un client</button>

      <div class="table-content">
         <?php
         // On affiche les données
         foreach ($data as $row) {

         ?>
            <div class="table-row7">
               <div class="table-data7"> <?= $row["email"] ?></div>
               <div class="table-data7"> <?= $row["id_client"] ?></div>
               <div class="table-data7"> <?= $row["nom"] ?></div>
               <div class="table-data7"> <?= $row["prenom"] ?></div>
               <div class="table-data7"> <?= $row["adresse"] ?></div>
               <div class="table-data7">
                  <a href="javascript:void(0)" onclick="if(confirm('Etes-vous sûr de vouloir supprimer le client de la table ?')) window.location='./UMDel.php?id=<?= $row["id_client"] ?>'">Suppr</a>
               </div>
            </div>
         <?php }
         ?>
      </div>
   </div>

</body>

</html>