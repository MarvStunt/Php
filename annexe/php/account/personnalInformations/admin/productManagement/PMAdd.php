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
   isset($_POST['referenceProduit']) &&
   isset($_POST['titreProduit']) &&
   isset($_POST['nom']) &&
   isset($_POST['prixPublic']) &&
   isset($_POST['prixAchat']) &&
   isset($_POST['image']) &&
   isset($_POST['auteur'])
) {
   // On vérifie que le produit n'est pas déjà dans la table produit
   $sql = "SELECT * FROM produit WHERE titreProduit = :titreProduit";
   $stmt = $pdo->prepare($sql);
   $stmt->execute(['titreProduit' => $_POST['titreProduit']]);
   $result = $stmt->fetch();

   if ($result) {
      header("Location: PM.php?error=Le produit est déjà dans la table produit");
      exit();
   } else {
      // On ajoute le produit à la table produit
      $sql = "INSERT INTO produit (referenceProduit, titreProduit, nom, prixPublic, prixAchat, image, iconePresentation, auteur) 
                        VALUES (:referenceProduit, :titreProduit, :nom, :prixPublic, :prixAchat, :image,:image, :auteur)";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([
         'referenceProduit' => $_POST['referenceProduit'],
         'titreProduit' => $_POST['titreProduit'],
         'nom' => $_POST['nom'],
         'prixPublic' => $_POST['prixPublic'],
         'prixAchat' => $_POST['prixAchat'],
         'image' => $_POST['image'],
         'auteur' => $_POST['auteur']
      ]);

      echo $pdo->errorInfo()[2];

      // On vérifie si la commande a bien été ajouté
      if ($stmt) {
         header("Location: PM.php?success=Produit ajouté avec succès");
         exit();
      } else {
         header("Location: PM.php?error=Erreur lors de l'ajout du produit");
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
      $current_page = "PMAdd";
      require_once(dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))) . "/menu.php");
      ?>
   </header>
   <div class="title">
      <h1>Ajout d'un produit</h1>
   </div>
   <form method="post">
      <label for="referenceProduit">Référence du nouveau produit :</label>
      <input type="text" id="referenceProduit" name="referenceProduit"><br>


      <label for="prixPublic">Prix public :</label>
      <input type="number" id="prixPublic" name="prixPublic" step="any"><br>

      <label for="prixAchat">Prix achat :</label>
      <input type="number" id="prixAchat" name="prixAchat" step="any"><br>

      <label for="image">Accronyme pour image :</label>
      <input type="text" id="image" name="image"><br>

      <label for="titreProduit">Titre du produit :</label>
      <input type="text" id="titreProduit" name="titreProduit"><br>

      <label for="nom">Nom :</label>
      <input type="text" id="nom" name="nom"><br>

      <label for="auteur">Auteur :</label>
      <input type="text" id="auteur" name="auteur"><br>

      <input type="submit" value="Confirmer" name="submit"><br>
   </form>
</body>

</html>