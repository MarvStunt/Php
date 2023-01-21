<?php
require_once dirname(__DIR__) . '/database/PDOSelect.php';
require_once dirname(__DIR__) . '/global.php';

// Vérification que les données existes et ne sont pas vides
if (!empty($_POST['E-mail']) && !empty($_POST['password'])) {
   $email = $_POST['E-mail'];
   $password = $_POST['password'];

   if (!preg_match(("/^[a-zA-Z0-9.]{2,}+@[a-zA-Z0-9]{2,}[.][a-zA-Z0-9]+/"), $email)) {
      header("Location: loginPage.php?error=email");
      die();
   }

   if (!preg_match('/^(?=.*[A-Z]{2,})(?=.*[0-9]{2,}).{8,}$/', $password)) {
      header("Location: loginPage.php?error=mdp");
      die();
   }
   $pdo = getPdo();
   // Préparation de la requête pour récupérer l'utilisateur avec l'email et le mot de passe saisis
   $requete = $pdo->prepare("SELECT * FROM client WHERE email = :email");
   $requete->bindParam(':email', $email);
   $requete->execute();
   $user = $requete->fetch(PDO::FETCH_ASSOC);

   // Vérification des identifiants
   if ($user && $password == $user['password']) {
      $_SESSION['user'] = $user;
      $_SESSION['login_time'] = time();
      $_SESSION['logged_in'] = true;
      $_SESSION['login'] = $user['email'];

      // Si il a cocher la case "souvenir de moi" alors on créer un cookie qui le garde en mémoir pendant 10 minutes
      if (!empty($_POST["souvenir"])) {
         setcookie("login", $user["email"], time() + 600);
      }

      header('Location:../../../index.php');
      die();
   } else {
      header("Location: loginPage.php?error=Compte inexistant");
      die();
   }
} else {
   header("Location: loginPage.php?error=Veuillez remplir tout les champs");
   die();
}
