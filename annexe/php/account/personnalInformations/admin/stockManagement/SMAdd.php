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

if (isset($_POST['submit']) && isset($_POST['id_produit']) && isset($_POST['quantite'])) {

   $id_produit = $_POST['id_produit'];
   $quantite = $_POST['quantite'];
   // On vérifie que le produit existe bien dans la table produit
   $sql = "SELECT * FROM produit WHERE id_produit = :id_produit";
   $stmt = $pdo->prepare($sql);
   $stmt->execute(['id_produit' => $_POST['id_produit']]);
   $result = $stmt->fetch();

   if (!$result) {
      header("Location: SM.php?error=Le produit n'existe pas");
      exit();
   }


   // On vérifie que le produit n'est pas déjà dans la table gestionStock
   $sql = "SELECT * FROM gestionStock WHERE id_produit = :id_produit";
   $stmt = $pdo->prepare($sql);
   $stmt->execute(['id_produit' => $id_produit]);
   $result = $stmt->fetch();

   if ($result) {
      header("Location: SM.php?error=Le produit est déjà dans la table gestionStock");
      exit();
   } else if ($quantite >= 0 && $quantite <= 500) {
      // Si le produit n'est pas dans la table gestionStock, on l'ajoute
      $sql = "INSERT INTO gestionStock (id_produit, quantite) VALUES (:id_produit, :quantite)";


      $stmt = $pdo->prepare($sql);
      $stmt->execute(['id_produit' => $id_produit, 'quantite' => $quantite]);
      header("Location: SM.php?success=Produit ajouté avec succès");
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
   <link rel="stylesheet" type="text/css" href="../../../../../css/style.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../../../../css/menu.css" media="screen" />
</head>

<body>
   <header>
      <?php
      $current_page = "SMAdd";
      require_once(dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))) . "/menu.php");
      ?>
   </header>
   <div class="title">
      <h1>Ajout d'un produit</h1>
   </div>
   <form method="post">
      <label for="id_produit">Id du nouveau produit :</label>
      <input type="number" id="id_produit" name="id_produit">

      <label for="quantite">Quantité :</label>
      <input type="number" id="quantite" name="quantite">

      <input type="submit" value="Confirmer" name="submit">
   </form>
</body>

</html>