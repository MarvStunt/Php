<!DOCTYPE html>
<html>

<head>
   <title>Créer un compte</title>
   <meta charset="utf-8">
   <link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../css/menu.css" media="screen" />
</head>

<body>
   <header>
   <?php
   $current_page = "registerPage";
   require_once(dirname(dirname(dirname(__DIR__))) . "/menu.php");
   
   ?>
   </header>
   <?php
   // On affiche le message d'erreur
   if (!empty($_GET["error"])) {
      echo "<p style='color:red'>" . $_GET["error"] . "</p>";
   }
   ?>
   <form action="register.php" method="post">
      <label for="email">E-mail</label>
      <input type="text" name="email" id="email">
      <label for="password">Mot de passe</label>
      <input type="password" name="password" id="password">
      <label for="nom">Nom</label>
      <input type="text" name="nom" id="nom">
      <label for="prenom">Prénom</label>
      <input type="text" name="prenom" id="prenom">
      <label for="adresse">Adresse</label>
      <input type="text" name="adresse" id="adresse">
      <input type="submit" value="Envoyer">
   </form>
</body>

</html>