<?php
// Connexion à la base de données
require_once dirname(__DIR__) . '/database/PDOSelect.php';


if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['adresse'])) {


   $email = $_POST['email'];
   $password = $_POST['password'];
   $nom = $_POST['nom'];
   $prenom = $_POST['prenom'];
   $adresse = $_POST['adresse'];

   if (!preg_match(('/^[- a-zA-Z]+$/'), $nom)) {
      header("Location: registerPage.php?error=nom");
      die();
   }

   if (!preg_match(('/^[- a-zA-Z]+$/'), $prenom)) {
      header("Location: registerPage.php?error=prenom");
      die();
   }

   if (!preg_match(("/^[a-zA-Z0-9.]{2,}+@[a-zA-Z0-9]{2,}[.][a-zA-Z0-9]+/"), $email)) {
      header("Location: registerPage.php?error=email");
      die();
   }

   if (!preg_match('/^(?=.*[A-Z]{2,})(?=.*[0-9]{2,}).{8,}$/', $password)) {
      header("Location: registerPage.php?error=mdp");
      die();
   }
   $pdo = getPdo();
   // Vérification de l'unicité de l'e-mail
   $requete = $pdo->prepare("SELECT email FROM client WHERE email = :email");
   $requete->bindParam(':email', $email);
   $requete->execute();
   $existing_email = $requete->fetchColumn();

   // Si l'email existe déjà alors erreur
   if ($existing_email) {
      echo 'Cet e-mail est déjà utilisé';
   } else {
      // Préparation de la requête d'insertion
      $requeteInsertion = $pdo->prepare("INSERT INTO client (email, password, nom, prenom, adresse) VALUES (:email, :password, :nom, :prenom, :adresse)");
      $requeteInsertion->bindParam(':email', $email);
      $requeteInsertion->bindParam(':password', $password);
      $requeteInsertion->bindParam(':nom', $nom);
      $requeteInsertion->bindParam(':prenom', $prenom);
      $requeteInsertion->bindParam(':adresse', $adresse);
      $requeteInsertion->execute();

      header('Location: loginPage.php?success=Votre compte a bien été créé');
      die();
   }
} else {
   header("Location: registerPage.php?error=Veuillez remplir tout les champs");
   die();
}
