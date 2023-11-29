<?php
// Démarrer la session
session_start();

// Détruire la session
session_destroy();

// Supprimer le cookie LOGGED_USER
if (isset($_COOKIE['LOGGED_USER'])) {
    unset($_COOKIE['LOGGED_USER']);
    setcookie('LOGGED_USER', null, -1, '/');
}

// Rediriger vers la page de connexion
header('Location: index.php');
exit();
?>
