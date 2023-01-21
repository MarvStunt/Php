<?php
require_once dirname(dirname(dirname(dirname(__DIR__)))) . '/global.php';
require_once dirname(dirname(dirname(dirname(__DIR__)))) . '/database/PDOSelect.php';

// On vérifie que ce soit bien le gérant du site qui est connecté
if ($_SESSION["user"]["email"] != "gerant@gmail.com") {
   header("Location: ../../../../../index.php");
   exit();
}

// Connection à la BDD
$pdo = getPDO();

// On vérifie la connection à la BDD
if (!$pdo) {
   header("Location: PM.php?error=Erreur lors de la connexion à la base de données");
   exit();
}

$id_produit = $_GET["id"];

if (isset($_POST['submit'])) {
   // On met à jour le produit en fonction des champs remplis
   if (!empty($_POST['prixPublic'])) {
      $prixPublic = $_POST['prixPublic'];
      $sql = $pdo->query("UPDATE produit SET prixPublic = $prixPublic WHERE id_produit = $id_produit");
   }

   if ($sql) {
      header("Location: PM.php?success=Produit mis à jour avec succès");
      exit();
   } else {
      header("Location: PM.php?error=Erreur lors de la mise à jour du produit");
      exit();
   }
}

?>

<!DOCTYPE html>
<html>

<head>
   <title>MAJ Produit</title>
   <link rel="stylesheet" type="text/css" href="../../../../../../css/style.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../../../../../css/menu.css" media="screen" />
</head>

<body>
   <header>
      <?php
      $current_page = "PMUpdate";
      require_once(dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))) . "/menu.php");
      ?>
   </header>
   <div class="title">
      <h1>Mise à jour d'un produit</h1>
   </div>
   <?= 'Id du produit : ' . $id_produit ?>
   <form method="post">
      <label for="prixPublic">Entrez le nouveau prix public :</label>
      <input type="number" id="prixPublic" name="prixPublic" step="any">
      <input type="submit" value="Confirmer" name="submit">
   </form>
</body>

</html>