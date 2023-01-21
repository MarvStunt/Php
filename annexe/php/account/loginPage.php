<?php
include dirname(__DIR__) . "/global.php";
// Si il est déjà connectre alors
if (isLoggedIn()) {
   // Redirige vers les informations de son compte
   header("Location: ./personnalInformations/myAccountPage.php");
}


// Gestion des erreurs / succés
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
   <title>Login</title>
   <meta charset="utf-8">
   <link rel="stylesheet" type="text/css" href="../../../css/style.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../../css/menu.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../../css/login.css" media="screen" />
</head>

<body>
   <header>
      <?php
      $current_page = "loginPage";
      require_once(dirname(dirname(dirname(__DIR__))) . "/menu.php");
      ?>
   </header>

   <div class="login-box">
      <h2>Se connecter</h2>
      <?php
      if (!empty($success)) {
      ?>
         <div class="success-message"><?= $success ?></div>
      <?php }
      if (!empty($error) && $error !== "email" && $error !== "mdp") {
      ?>
         <div class="error-message"><?= $error ?></div>
      <?php } ?>

      <form action="login.php" method="post">
         <div class="user-box">
            <input type="text" name="E-mail" id="E-mail" required="" autocomplete="off">

            <label>E-mail</label>
            <?php if (!empty($error) && $error === "email") { ?>
               <div class="error-message">E-mail invalide</div>
            <?php } ?>
         </div>
         <div class="user-box">
            <input type="password" name="password" id="password" required="" autocomplete="off">
            <label>Mot de passe</label>
            <?php if (!empty($error) && $error === "mdp") { ?>
               <div class="error-message">Mot de passe incorect</div>
            <?php } ?>
         </div>


         <div class="remember">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember"></label>
            <label class="text" for="remember">Se souvenir de moi</label>
         </div>
         <div class="connection">
            <input class="connect" type="submit" value="Se connecter">
         </div>
         <div class="register">
            <span class="txt1">
               Vous n'avez pas de compte ?
            </span>
            <a class="txt2" href="registerPage.php">
               s'inscrire
            </a>
         </div>
      </form>
   </div>
</body>

</html>