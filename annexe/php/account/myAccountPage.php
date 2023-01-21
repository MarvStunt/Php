<?php
require_once dirname(__DIR__) . '/global.php';
require_once dirname(__DIR__) . '/database/PDOSelect.php';

if (!isLoggedIn()) {
   header("Location: loginPage.php?error=Veuillez vous connecter pour accéder à votre panier");
   exit();
}
$pdo = getPDO();
// récupération des infos du client
$requeteClient = $pdo->query("SELECT * FROM client WHERE id_client = " . $_SESSION["user"]["id_client"]);
$client = $requeteClient->fetch(PDO::FETCH_ASSOC);

$nom = $client["nom"];
$prenom = $client["prenom"];
$email = $client["email"];
$password = $client["password"];


?>

<!DOCTYPE html>
<html>

<head>
   <title>Mon compte</title>
   <link rel="stylesheet" type="text/css" href="../../../css/style.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../../css/menu.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../../css/basket.css" media="screen" />
</head>

<body>
   <header>
      <?php
      $current_page = "myAccountPage";
      require_once(dirname(dirname(dirname(__DIR__))) . "/menu.php");
      ?>
   </header>
   <script>
      function showPassword() {
         var x = document.getElementById("password");
         if (x.type === "password") {
            x.type = "text";
         } else {
            x.type = "password";
         }
      }
   </script>
   <h1>Mon compte</h1>

   <head>
      <title>Informations client</title>
   </head>

   <body>
      <h2>Informations client</h1>
         <table>
            <tr>
               <td>Nom <?= $nom ?></td>
            </tr>
            <tr>
               <td>Prénom: <?= $prenom ?></td>
            </tr>
            <tr>
               <td>E-mail: <?= $email ?></td>
            </tr>
            <tr>
               <td>Mot de passe: <input type="password" id="password" value="<?= $password ?>" disabled> <button onclick="showPassword()"><img src="../../../assets/img/eye.png"></button></td>
            </tr>
         </table>

         <!-- Faire un bouton "se déconnecter" qui destroy la session actuelle -->
         <button onclick="location.href='logout.php'">Se déconnecter</a>
   </body>

</html>