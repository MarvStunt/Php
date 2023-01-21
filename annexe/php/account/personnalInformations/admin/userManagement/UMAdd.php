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

// On vérifie que les champs sont bien remplis
if (
   isset($_POST['submit']) &&
   isset($_POST['password']) &&
   isset($_POST['prenom']) &&
   isset($_POST['nom']) &&
   isset($_POST['email']) &&
   isset($_POST['adresse']) 
) {

   // On vérifie que le client ne soit pas déjà dans la table
   $sql = "SELECT * FROM client WHERE email = :email";
   $stmt = $pdo->prepare($sql);
   $stmt->execute(['email' => $_POST['email']]);
   $result = $stmt->fetch();
   
   if ($result) {
      header("Location: PM.php?error=L'email est déjà dans la table client");
      exit();
   } else {
      // On ajoute le produit à la table produit
      $sql = "INSERT INTO client (password, prenom, nom, email, adresse) 
                        VALUES (:password, :prenom, :nom, :email, :adresse)";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([
         'password' => $_POST['password'],
         'prenom' => $_POST['prenom'],
         'nom' => $_POST['nom'],
         'email' => $_POST['email'],
         'adresse' => $_POST['adresse'],
      ]);

      echo $pdo->errorInfo()[2];

      // On vérifie si la commande a bien été ajouté
      if ($stmt) {
         header("Location: UM.php?success=Client ajouté avec succès");
         exit();
      } else {
         header("Location: UM.php?error=Erreur lors de l'ajout du Client");
         exit();
      }
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
      $current_page = "UMadd";
      require_once(dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))) . "/menu.php");
      ?>
   </header>
   <div class="title">
      <h1>Gestion des produits</h1>
   </div>
   <form method="post">
      <label for="nom">Nom :</label>
      <input type="text" id="nom" name="nom"><br>


      <label for="prenom">Prenom :</label>
      <input type="text" id="prenom" name="prenom"><br>

      <label for="email">E-mail :</label>
      <input type="text" id="email" name="email"><br>

      <label for="adresse">Adresse :</label>
      <input type="text" id="adresse" name="adresse"><br>

      <!-- On laisse le mot de passe afficher car c'est un admin qui le rentre -->
      <label for="password">Mot de passe :</label>
      <input type="text" id="password" name="password"><br>

      <input type="submit" value="Confirmer" name="submit"><br>
   </form>
</body>

</html>