<?php
// Lance la session
session_start();

/**
 * Vérifie si l'utilisateur est connecté
 *
 * @return boolean true si l'utilisateur est connecté, false sinon
 */
function isLoggedIn() {
   return !empty($_SESSION["login"]);
}