<?php
session_start();

if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"] != true) {
    header("Location: ../../index.php");
    exit();
}elseif(isset($_SESSION["Admin"]) && $_SESSION["Admin"] == true){
    // Connexion à la base de données
    require_once "../DBConnect/DB_Conn.php";

    // Récupération de l'ID à partir de l'URL
    $id = $_GET['id'];

    // Vérification que l'ID est bien un nombre (simple mesure de sécurité)
    if (!is_numeric($id)) {
        die("Invalid ID");
    }

    // Requête de suppression
    $query = $conn->prepare("DELETE FROM T_joueur WHERE J_Id = ?");
    $query->execute([$id]);

    // Redirection vers Admin.php après la suppression
    header("Location: ./Admin.php");
    exit();
}
?>