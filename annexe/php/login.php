<?php
require_once __DIR__ . 'BDD.php';

session_start();

// Connection à la BDD
try {
    $conn = BDD::getPdo();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error : " . $e->getMessage();
    die();
}

// Vérification que les données existes et ne sont pas vides
if (isset($_POST['E-mail']) && isset($_POST['password'])) {
    $email = $_POST['E-mail'];
    $password = $_POST['password'];

    // Préparation de la requête pour récupérer l'utilisateur avec l'email et le mot de passe saisis
    $requete = $conn->prepare("SELECT * FROM client WHERE email = :email");
    $requete->bindParam(':email', $email);
    $requete->execute();
    $user = $requete->fetch(PDO::FETCH_ASSOC);

    // Vérification des identifiants
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        $_SESSION['login_time'] = time();
        $_SESSION['logged_in'] = true;

        header('Location: profile.php');
        exit;
    } else {
        echo 'Identifiants incorrects';
    }
}
?>