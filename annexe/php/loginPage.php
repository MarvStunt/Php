<html>

<head>
   <title>Login</title>
   <meta charset="utf-8">
   <link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen" />
   <link rel="stylesheet" type="text/css" href="../../css/menu.css" media="screen" />
</head>

<body>
   <header>
      <?php
      $current_page = "loginPage";
      require_once(dirname(dirname(__DIR__)) . "/menu.php");
      ?>
   </header>
   <?php
   // On affiche le message d'erreur
   if (!empty($_GET["error"])) {
      echo "<p style='color:red'>" . $_GET["error"] . "</p>";
   }

   if(!empty($_GET["success"])){
      echo "<p style='color:green'>" . $_GET["success"] . "</p>";
   }
   ?>
   <form action="login.php" method="post">
      <label for="E-mail">E-mail</label>
      <input type="text" name="E-mail" id="E-mail">
      <label for="password">Mot de passe</label>
      <input type="password" name="password" id="password">
      <label for="remember">se souvenir de moi</label>
      <input type="checkbox" name="remember" id="remember">
      <input type="submit" value="Se connecter">
      <div class="register">
         <span class="txt1">
            Vous n'avez pas de compte ?
         </span>

         <a class="txt2" href="registerPage.php">
            s'inscrire
         </a>
      </div>
   </form>
</body>

</html>