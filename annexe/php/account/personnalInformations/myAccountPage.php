<?php
require_once dirname(dirname(__DIR__)) . '/global.php';
require_once dirname(dirname(__DIR__)) . '/database/PDOSelect.php';

if (!isLoggedIn()) {
   header("Location: loginPage.php?error=Veuillez vous connecter pour accéder à votre panier");
   exit();
}
$pdo = getPDO();

// On vérifie la connection à la BDD
if ($pdo == null) {
   header("Location: ../../../index.php?error=Erreur de connexion à la base de données");
   exit();
}

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
   <title>Informations client</title>
   <link rel="icon" type="image/png" href="../../../../assets/img/logo.png" />
   <link rel="stylesheet" type="text/css" href="../../../../css/style.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../../../css/menu.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../../../css/account.css" media="screen" />
</head>

<body>
   <header>
      <?php
      $current_page = "myAccountPage";
      require_once(dirname(dirname(dirname(dirname(__DIR__)))) . "/menu.php");
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
   <main>
      <div class="title">
         <h1>Mon compte</h1>
      </div>

      <div class="personnalInfos">
         <div class="write">
            <div class="infos">
               <div class="infoName">
                  Nom :</div>
               <div class="reveal"><?= $nom ?></div>
            </div>
            <div class="infos">
               <div class="infoName">
                  Prénom :</div>
               <div class="reveal"><?= $prenom ?></div>
            </div>
            <div class="infos">
               <div class="infoName">
                  E-mail :</div>
               <div class="reveal"><?= $email ?></div>
            </div>
            <div class="infos">
               <div class="infoName">
                  Mot de passe :</div><input class="mdp" type="password" id="password" value="<?= $password ?>" disabled>
               <button class="btn" id="password" onclick="showPassword()"><img src="../../../../assets/img/eye.png"></button>
            </div>
         </div>
         <div class="buttons">
            <button class="btn" onclick="location.href='./billingPage.php'">Consulter mes dernières facturations</button>
            <!-- Bouton "se déconnecter" qui destroy la session actuelle -->
            <button class="btn" onclick="location.href='../logout.php'">Se déconnecter</button>
            <!-- Bouton qui redirige sur la page admin que si c'est le gérant -->
            <?php if ($_SESSION["user"]["email"] == "gerant@gmail.com") { ?>
               <button class="btn" onclick="location.href='./adminPage.php'">Page d'administration</button>
            <?php } ?>
         </div>
      </div>
   </main>
</body>

</html>