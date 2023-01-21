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
   header("Location: PrM.php?error=Erreur lors de la connexion à la base de données");
   exit();
}

$id_fournisseur = $_GET["id"];
if(isset($_POST['submit'])) {
   if (!empty($_POST['submit']) && !empty($_POST['nom']) && !empty($_POST['numTelephone'])) {
      $sql = "UPDATE fournisseur SET numTelephone = :numTelephone, nom=:nom WHERE id_fournisseur = :id_fournisseur";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':numTelephone', $_POST['numTelephone']);
      $stmt->bindParam(':nom', $_POST['nom']);
      $stmt->bindParam(':id_fournisseur', $id_fournisseur);
      $stmt->execute();
      header("Location: PrM.php?success=Fournisseur mis à jour avec succès.");
      exit();
   } else {
      header("Location: PrM.php?error=Erreur lors de la mise à jour du fournisseur.");
      exit();
   }
}

?>

<!DOCTYPE html>
<html>

<head>
   <title>MAJ Fournisseur</title>
   <link rel="stylesheet" type="text/css" href="../../../../../../css/style.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../../../../../css/menu.css" media="screen" />
</head>

<body>
   <header>
      <?php
      $current_page = "PrMUpdate";
      require_once(dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))) . "/menu.php");
      ?>
   </header>
   <div class="title">
      <h1>Mise à jour d'un fournisseur</h1>
   </div>
   <?= 'Id du fournisseur : ' . $id_fournisseur ?>
   <form method="post">
      <label for="numTelephone">Numéro de téléphone :</label>
      <input type="text" id="numTelephone" name="numTelephone">
      
      <label for="nom">Nom :</label>
      <input type="text" id="nom" name="nom">

      <input type="submit" value="Confirmer" name="submit">
   </form>
</body>

</html>