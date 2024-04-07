<?php
session_start(); // Commence la session

// Vide toutes les variables de sessions
$_SESSION = array();

// Détruie les cookies de sessions
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Détruit la session
session_destroy();

// Ramène à la page d'accueil
header("Location: ../../index.php");
exit();
?>
