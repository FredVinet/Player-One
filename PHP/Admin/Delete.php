<?php
session_start();

if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"] != true) {
    header("Location: ../../index.php");
    exit();
} elseif (isset($_SESSION["Admin"]) && $_SESSION["Admin"] == true && isset($_GET['idDelete'])) {
    // Connexion à la base de données
    require_once "../DBConnect/DB_Conn.php";

    // Récupération de l'ID à partir de l'URL
    $id = $_GET['idDelete'];

    // Vérification que l'ID est bien un nombre (simple mesure de sécurité)
    if (!is_numeric($id)) {
        die("Invalid ID");
    }

    // Requête de suppression
    $sqlDelete = "DELETE FROM T_joueur WHERE J_Id = ?";
    $stmt = $conn->prepare($sqlDelete);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Fermeture de la requête
    $stmt->close();

    // Redirection vers Admin.php après la suppression
    header("Location: ./Admin.php");
    exit();
}

// Reste de votre code pour afficher les utilisateurs et leurs actions
?>
