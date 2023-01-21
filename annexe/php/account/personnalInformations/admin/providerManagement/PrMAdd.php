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
   header("Location: PrM.php?error=Erreur lors de la connexion à la base de données");
   exit();
}

// On vérifie que les champs sont bien remplis
if (
   isset($_POST['submit']) &&
   isset($_POST['numTelephone']) &&
   isset($_POST['nom']) 
) {

   // On vérifie que le client ne soit pas déjà dans la table
   $sql = "SELECT * FROM fournisseur WHERE numTelephone = :numTelephone";
   $stmt = $pdo->prepare($sql);
   $stmt->execute(['numTelephone' => $_POST['numTelephone']]);
   $result = $stmt->fetch();

   
   if ($result) {
      header("Location: PM.php?error=Le fournisseur est déjà dans la table");
      exit();
   } else {
      // On ajoute le fournisseur à la table
      $sql = "INSERT INTO fournisseur (numTelephone, nom) 
                        VALUES (:numTelephone, :nom)";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([
         'numTelephone' => $_POST['numTelephone'],
         'nom' => $_POST['nom'],
      ]);


      // On vérifie si le fournisseur a bien été ajouté
      if ($stmt) {
         header("Location: PrM.php?success=Fournisseur ajouté avec succès");
         exit();
      } else {
         header("Location: PrM.php?error=Erreur lors de l'ajout du fournisseur");
         exit();
      }
   }
}


?>

<!DOCTYPE html>
<html>

<head>
   <title>MAJ fournisseur</title>
   <link rel="stylesheet" type="text/css" href="../../../../../../css/style.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../../../../../css/menu.css" media="screen" />
</head>

<body>
   <header>
      <?php
      $current_page = "PrMAdd";
      require_once(dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))) . "/menu.php");
      ?>
   </header>
   <div class="title">
      <h1>Gestion des fournisseur</h1>
   </div>
   <form method="post">
      <label for="nom">Nom :</label>
      <input type="text" id="nom" name="nom"><br>

      <label for="numTelephone">Numero de téléphone :</label>
      <input type="text" id="numTelephone" name="numTelephone"><br>

      <input type="submit" value="Confirmer" name="submit"><br>
   </form>
</body>

</html>