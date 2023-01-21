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
   header("Location: SM.php?error=Erreur lors de la connexion à la base de données");
   exit();
}

$id_produit = $_GET["id"];

if (isset($_POST['submit'])) {
   $inputValue = $_POST['inputValue'];
   // vérifie que la valeur soit comprise entre 0 et 500
   if ($inputValue >= 0 && $inputValue <= 500) {
      $id = $_GET['id'];
      $sql = "UPDATE gestionStock SET quantite = :inputValue WHERE id_produit = :id_produit";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':inputValue', $inputValue);
      $stmt->bindParam(':id_produit', $id_produit);
      $stmt->execute();
      header("Location: SM.php?success=Valeur mis à jour avec succès.");
      exit();
   } else {
      header("Location: SM.php?error=Veuillez entrer une valeur comprise entre 0 et 500");
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
      $current_page = "stockManagementUpdate";
      require_once(dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))) . "/menu.php");
      ?>
   </header>
   <div class="title">
      <h1>Mise à jour d'un produit</h1>
   </div>
   <?= 'Id du produit : ' . $id_produit ?>
   <form method="post">
      <label for="inputValue">Entrez votre valeur :</label>
      <input type="text" id="inputValue" name="inputValue">
      <input type="submit" value="Confirmer" name="submit">
   </form>
</body>

</html>