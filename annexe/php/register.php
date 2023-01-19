<?php
require_once __DIR__ . '/BDD.php';
// Connexion à la base de données
try {
   $BDD = new BDD();
   $conn = $BDD->getPDO();
} catch (PDOException $e) {
   echo "Error : " . $e->getMessage();
   die();
}

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['adresse'])) {
   $email = $_POST['email'];
   $password = $_POST['password'];
   $nom = $_POST['nom'];
   $prenom = $_POST['prenom'];
   $adresse = $_POST['adresse'];
   $hashed_password = password_hash($password, PASSWORD_BCRYPT);
   // Vérification de l'unicité de l'e-mail
   $requete = $conn->prepare("SELECT email FROM client WHERE email = :email");
   $requete->bindParam(':email', $email);
   $requete->execute();
   $existing_email = $requete->fetchColumn();

   // Si l'email existe déjà alors erreur
   if ($existing_email) {
      echo 'Cet e-mail est déjà utilisé';
   } else {
      // Préparation de la requête d'insertion
      $requeteInsertion = $conn->prepare("INSERT INTO client (email, password, nom, prenom, adresse) VALUES (:email, :password, :nom, :prenom, :adresse)");
      $requeteInsertion->bindParam(':email', $email);
      $requeteInsertion->bindParam(':password', $hashed_password);
      $requeteInsertion->bindParam(':nom', $nom);
      $requeteInsertion->bindParam(':prenom', $prenom);
      $requeteInsertion->bindParam(':adresse', $adresse);
      $requeteInsertion->execute();

      echo 'Compte créé avec succès';
   }
}
