<?php
if (!empty($_GET["success"])) {
   $success = htmlspecialchars($_GET["success"]);
}
if (!empty($_GET["error"])) {
   $error = htmlspecialchars($_GET["error"]);
}
?>

<!DOCTYPE html>
<html>

<head>
   <title>Créer un compte</title>
   <meta charset="utf-8">
   <link rel="stylesheet" type="text/css" href="../../../css/style.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../../css/menu.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../../css/register.css" media="screen" />
</head>

<body>
   <header>
      <?php
      $current_page = "registerPage";
      require_once(dirname(dirname(dirname(__DIR__))) . "/menu.php");

      ?>
   </header>

   <div class="login-box">
      <h2>S'inscrire</h2>
      <?php
      // On affiche le message d'erreur
      if (!empty($error) && $error !== "email" && $error === "nom" && $error === "prenom" && $error === "adresse" && $error === "mdp") { ?>
         <div class="error-message"><?= $error ?></div>
      <?php } ?>

      <form action="register.php" method="post">

         <div class="personnal">
            <div class="user-box">
               <input autocomplete="off"  type="text" name="nom" id="nom" required="" >

               <label for="nom">Nom</label>
               <?php if (!empty($error) && $error === "nom") { ?>
                  <div class="error-message">choissisez un nom valide</div>
               <?php } ?>
            </div>

            <div class="user-box">
               <input autocomplete="off"  type="text" name="prenom" id="prenom" required="" >

               <label for="prenom">Prénom</label>
               <?php if (!empty($error) && $error === "prenom") { ?>
                  <div class="error-message">choissisez un prenom valide</div>
               <?php } ?>
            </div>
         </div>

         <div class="user-box">
            <input autocomplete="off"  type="text" name="adresse" id="adresse" required="" >

            <label for="adresse">Adresse</label>
            <?php if (!empty($error) && $error === "adresse") { ?>
               <div class="error-message">choissisez une adresse valide</div>
            <?php } ?>
         </div>

         <div class="user-box">
            <input autocomplete="off"  type="text" name="email" id="email" required="" >

            <label>E-mail</label>
            <?php if (!empty($error) && $error === "email") { ?>
               <div class="error-message">e-mail invalide</div>
            <?php } ?>
         </div>

         <div class="user-box">
            <input autocomplete="off"  type="password" name="password" id="password" required="" >

            <label>Mot de passe</label>
            <?php if (!empty($error) && $error === "mdp") { ?>
               <div class="error-message">Le mot de passe doit contenir 2 majuscules, 2 chiffres et 8 lettres minimum</div>
            <?php } ?>
         </div>

         <div class="register">
            <input autocomplete="off"  class="registered" type="submit" value="S'inscrire">
         </div>
         <div class="register">
            <span class="txt1">
               Vous avez déjà un compte ?
            </span>
            <a class="txt2" href="loginPage.php">
               se connecter
            </a>
         </div>
   </div>
   </form>
</body>

</html>