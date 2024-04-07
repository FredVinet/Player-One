<?php
session_start();

if (!isset($_SESSION["Admin"]) || $_SESSION["Admin"] != true) {
    //Si l'utilisateur n'est pas Admin retourne vers la page d'accueil
    header("Location: ../../index.php");
    exit();
} elseif (isset($_SESSION["Admin"]) && $_SESSION["Admin"] == true && isset($_GET['idDelete']) && isset($_GET['typeDelete'])) {
    // Connexion à la base de données
    require_once "../DBConnect/DB_Conn.php";


    // Récupération de l'ID et du Type à partir de l'URL
    $id = $_GET['idDelete'];
    $type = $_GET['typeDelete'];

    //Mise en place de la variables errors en tableau
    $errors = array();
    // Vérification que l'ID est bien un nombre (simple mesure de sécurité)
    if (!is_numeric($id)) {
        array_push($errors, "Id must be a number");
    }
    if($type != 'Admin' && $type != 'User'){
        array_push($errors, "Type must be User or Admin");
    }
    if($type == 'Admin'){
        array_push($errors, "You can't delete an Admin");
    }
    if(count($errors) > 0){
        
        $_SESSION['errorsDelete'] = $errors;
        foreach($errors as $error){
            echo"<div class='alert alert-danger'>$error</div>";
        }
        header("Location: ./Admin.php"); // Redirection vers la même page pour afficher la modal d'erreur
        exit();
    }else{ //S'il n'y a pas d'erreur ouvre la base de données
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
    
}