<html>

<head>
   <title>Login</title>
   <meta charset="utf-8">
   <link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen" />
</head>

<body>
   <header>
      <?php
      $current_page = "loginPage";
      require_once(dirname(dirname(__DIR__)) . "/menu.php");
      ?>
   </header>
   <form action="index.html" method="post">
      <label for="Identifiant">Identifiant</label>
      <input type="text" name="Identifiant" id="Identifiant">
      <label for="password" require>Mot de passe</label>
      <input type="password" name="password" id="password">
      <input type="submit" value="Envoyer">
   </form>
</body>

</html>