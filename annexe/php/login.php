<?php
require_once __DIR__ . '/PDOSelect.php';
$pdo = getPdo();

// Vérification que les données existes et ne sont pas vides
if (!empty($_POST['E-mail']) && !empty($_POST['password'])) {
   $email = $_POST['E-mail'];
   $password = $_POST['password'];
   
   if (!preg_match(("/^[a-zA-Z0-9.]{2,}+@[a-zA-Z0-9]{2,}[.][a-zA-Z0-9]+/"), $email)) {
      header("Location: loginPage.php?error=Mauvaise saisis de l'e-mail.");
      die();
   }
   
   if(!preg_match('/^(?=.*[A-Z]{2,})(?=.*[0-9]{2,}).{8,}$/',$password)){
      header("Location: loginPage.php?error=Mauvaise saisis du mot de passe. Il doit contenir au moins 8 caractères, 2 chiffres et 2 majuscules.");
      die();
   }
   
   session_start();
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

        header('Location:../../index.php');
        die();
    } else {
      header("Location: loginPage.php?error=Identifiants incorrects");
      die();
    }
} else {
   header("Location: loginPage.php?error=Veuillez remplir tout les champs");
   die();
}
