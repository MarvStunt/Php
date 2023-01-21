<?php
require_once(dirname(__DIR__) . "/global.php");

// Détruis la session actuelle
session_destroy();

// Redirige vers la page d'accueil
header("Location: ../../../index.php");